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
        $roomName = $request->input('room');
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');
        $amenityName = $request->input('amenity');

        // Log the values for debugging
        Log::debug('Reservation Details:', [
            'roomName' => $roomName,
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
            'amenityName' => $amenityName
        ]);

        // Retrieve room details (all available room IDs for the selected room name)
        $rooms = Room::where('room_name', $roomName)->get();

        Log::debug('Available Rooms:', $rooms->toArray());

        // Check for available rooms
        $availableRoom = null;
        foreach ($rooms as $room) {
            $reservationsCount = Reservation::where('room_id', $room->id)
                ->where(function ($query) use ($checkInDate, $checkOutDate) {
                    $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                        ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                        ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$checkInDate])
                        ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$checkOutDate]);
                })->count();

            // If the room is available (not fully booked), select it
            if ($room->availability_status == 'available') {
                $availableRoom = $room;
                break;  // Select the first available room and exit the loop
            }
        }


        Log::debug('Available Room:', $availableRoom ? $availableRoom->toArray() : ['message' => 'No available room found']);

        // If no rooms are available, return error
        if (!$availableRoom) {
            return response()->json(['error' => 'No rooms available for the selected dates'], 400);
        }

        // Use the randomly selected available room
        $room_id = $availableRoom->room_id;

        // Check if the selected available room is fully booked
        $reservationsCount = Reservation::where('room_id', $room_id)  // Use $room_id here
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                    ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$checkInDate])
                    ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$checkOutDate]);
            })->count();


        if ($reservationsCount == 1) {
            return response()->json(['error' => 'Room is fully booked for the selected dates'], 400);
        }

        // Calculate total price
        $roomPrice = $room->price_per_night;
        $checkIn = \Carbon\Carbon::parse($checkInDate);
        $checkOut = \Carbon\Carbon::parse($checkOutDate);
        $nights = $checkIn->diffInDays($checkOut);
        $totalRoomPrice = $roomPrice * $nights;

        $amenityPrice = 0;
        $amenityId = 0;
        if ($amenityName) {
            $amenity = Amenities::where('amenity_name', $amenityName)->first();
            $amenityPrice = $amenity ? $amenity->price_per_use : 0;
            $amenityId = $amenity ? $amenity->amenity_id : 0;
        }

        $totalPrice = $totalRoomPrice + $amenityPrice;
        $idAmenity = $amenityId;
        // Log the amenityId after it's been set
        Log::debug('Selected Amenity ID Type:', [
            'amenity_id_type' => gettype($idAmenity),
        ]);


        // Create a reservation record
        $reservation = Reservation::create([
            'user_id' => auth()->user()->id,
            'room_id' => $room->room_id,
            'amenity_id' => $idAmenity,
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'total_price' => $totalPrice,
            'reservation_status' => 'reserved',
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

        return view('reservationsuccess'); // Create a success page
    }

    public function cancel()
    {
        return redirect()->route('book');
    }
}
