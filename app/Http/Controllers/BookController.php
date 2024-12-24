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

        // Retrieve room price per night from the database
        $room = Room::where('room_name', $roomName)->first();
        $roomPrice = $room ? $room->price_per_night : 0; // Get the price per night for the selected room

        // Calculate the number of nights (assuming the dates are in 'Y-m-d' format)
        $checkIn = \Carbon\Carbon::parse($checkInDate);
        $checkOut = \Carbon\Carbon::parse($checkOutDate);
        $nights = $checkIn->diffInDays($checkOut); // Calculate the number of days between check-in and check-out

        // Calculate the total room price (room price per night * number of nights)
        $totalRoomPrice = $roomPrice * $nights;

        // Retrieve amenity price per use from the database (if an amenity is selected)
        $amenityPrice = 0; // Default value if no amenity is selected
        if ($amenityName) {
            $amenity = Amenities::where('amenity_name', $amenityName)->first();
            $amenityPrice = $amenity ? $amenity->price_per_use : 0; // Get the price per use for the selected amenity
        }

        // Calculate the total price (room price + amenity price)
        $totalPrice = $totalRoomPrice + $amenityPrice;

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
