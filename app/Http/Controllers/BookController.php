<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Models\Room;
use App\Models\Amenities;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index(): Factory|View
    {
        return view('reservation');
    }

    public function getRoomNamesWithPrices()
    {
        $rooms = Room::select('room_name', 'price_per_night')
            ->distinct('room_name')
            ->groupBy('room_name', 'price_per_night')
            ->get();

        return response()->json($rooms);
    }

    public function getAmenityNamesWithPrices()
    {
        $amenities = Amenities::select('amenity_name', 'price_per_use')->get();
        return response()->json($amenities);
    }

    public function reserve(Request $request)
    {
        // Initialize Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Retrieve reservation details from the request
        $roomName = $request->input('room_name');
        $checkInDate = $request->input('check_in_date');
        $checkOutDate = $request->input('check_out_date');
        $amenityName = $request->input('amenity_name');

        // Retrieve room details (all available room IDs for the selected room name)
        $rooms = Room::where('room_name', $roomName)->get();

        // Check for available rooms
        $availableRoom = null;
        foreach ($rooms as $room) {
            // Count reservations for the specified room and date range
            $reservationsCount = Reservation::where('room_id', $room->room_id)
                ->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                ->where(function ($query) use ($checkInDate, $checkOutDate) {
                    $query->where(function ($subQuery) use ($checkInDate, $checkOutDate) {
                        $subQuery->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                            ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate]);
                    })
                        ->orWhereRaw('DATE(check_in_date) = DATE(?) AND DATE(check_out_date) = DATE(?)', [$checkInDate, $checkOutDate]);
                })
                ->exists();

            // If no reservations overlap and the room is available, select it
            if (!$reservationsCount && $room->availability_status == 'available') {
                $availableRoom = $room;
                break;  // Select the first available room and exit the loop
            }
        }
        // If no rooms are available, return error
        if (!$availableRoom) {
            return response()->json(['error' => 'No rooms available for the selected dates'], 400);
        }

        // Use the randomly selected available room
        $room_id = $availableRoom->room_id;

        if ($reservationsCount > 0) {
            return response()->json(['error' => 'Room is partially booked for the selected dates'], 400);
        }

        // Calculate total price
        $roomPrice = $room->price_per_night;
        $checkIn = \Carbon\Carbon::parse($checkInDate);
        $checkOut = \Carbon\Carbon::parse($checkOutDate);
        $nights = $checkIn->diffInDays($checkOut);

        $totalRoomPrice = $roomPrice * $nights;

        // Apply "Stay Longer and Save" Discount
        if ($nights >= 14) {
            $discount = 0.50; // 50% discount
        } elseif ($nights >= 12) {
            $discount = 0.40; // 40% discount
        } elseif ($nights >= 10) {
            $discount = 0.30; // 30% discount
        } elseif ($nights >= 7) {
            $discount = 0.20; // 20% discount
        } else {
            $discount = 0.0; // No discount
        }

        $totalRoomPrice -= $totalRoomPrice * $discount;

        // Apply "Book in Advance" Discount
        $daysInAdvance = \Carbon\Carbon::now()->diffInDays($checkIn);
        if ($daysInAdvance >= 30 && $nights >= 3) {
            $totalRoomPrice -= $totalRoomPrice * 0.20; // Additional 20% discount
        }

        $amenityPrice = 0;
        $amenityId = 0;
        if ($amenityName) {
            $amenity = Amenities::where('amenity_name', $amenityName)->first();
            $amenityPrice = $amenity ? $amenity->price_per_use : 0;
            $amenityId = $amenity ? $amenity->amenity_id : 0;
        }

        $totalPrice = $totalRoomPrice + $amenityPrice;
        $idAmenity = $amenityId;

        // Store reservation data in session
        session([
            'reservation_data' => [
                'user_id' => auth()->user()->id,
                'room_id' => $availableRoom->room_id,
                'amenity_id' => $idAmenity,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'total_price' => $totalPrice,
            ]
        ]);

        // Create a Stripe Checkout session

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'php', // Currency
                    'product_data' => [
                        'name' => 'Room Reservation: ' . $roomName,
                        'description' =>
                        'Check-in Date: ' . $checkInDate . ' | ' .
                            'Check-out Date: ' . $checkOutDate . ' | ' .
                            'Amenity: ' . $amenityName
                    ],
                    'unit_amount' => $totalPrice * 100, // Convert total price to cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('reservation.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url' => route('reservation.cancel'),
        ]);

        // Redirect to Stripe Checkout page

        return response()->json(['url' => $session->url]);
    }

    public function success(Request $request)
    {
        // Retrieve the session ID
        $sessionId = $request->query('session_id');

        // Retrieve reservation data from session
        $reservationData = session('reservation_data');

        if (!$reservationData) {
            return redirect()->route('home')->with('error', 'Reservation data not found.');
        }

        // Create the reservation record
        $reservation = Reservation::create([
            'user_id' => $reservationData['user_id'],
            'room_id' => $reservationData['room_id'],
            'amenity_id' => $reservationData['amenity_id'],
            'check_in_date' => $reservationData['check_in_date'],
            'check_out_date' => $reservationData['check_out_date'],
            'total_price' => $reservationData['total_price'],
            'reservation_status' => 'reserved',
        ]);

        // Load the related room data
        $reservation->load('room');

        // Clear the session data
        session()->forget('reservation_data');

        // Pass the reservation data to the view
        return view('reservationsuccess', [
            'reservation' => $reservation,
        ]);
    }

    public function cancel()
    {
        return redirect()->route('book');
    }

    public function myReservations()
    {
        // Fetch reservations for the authenticated user
        $reservations = Reservation::with('room', 'amenity') // Load related room and amenity data
            ->where('user_id', auth()->id()) // Filter by the logged-in user's ID
            ->orderBy('check_in_date', 'asc') // Optional: Order by check-in date
            ->get();

        // Pass reservations to the view
        return view('myreservation', compact('reservations'));
    }

    public function update(Request $request, $reservation_id)
    {
        $reservation = Reservation::where('reservation_id', $reservation_id)->firstOrFail();

        if ($request->has('reservation_status') && $request->reservation_status === 'Pending') {
            $reservation->reservation_status = 'Pending';
            $reservation->save();

            return redirect()->back()->with('success', 'Cancellation request submitted and is now pending.');
        }

        // Handle other updates if necessary
    }

    public function confirmCancellation(Request $request, $reservation_id)
    {
        $reservation = Reservation::where('reservation_id', $reservation_id)->firstOrFail();
    
        if ($reservation->reservation_status === 'Pending') {
            $reservation->reservation_status = 'Cancelled'; // Or 'Confirmed', depending on your workflow
            $reservation->save();
    
            return redirect()->back()->with('success', 'Reservation cancellation confirmed.');
        }
    
        return redirect()->back()->with('error', 'Invalid operation.');
    }

    public function cancelRequest() {
        // Fetch reservations where status is "Pending"
        $reservations = Reservation::where('reservation_status', 'Pending')->get();
    
        // Pass the pending cancellations to the view
        return view('admin.cancelrequest', compact('reservations'));
    }
}
