<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    // Store a newly created room
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms',
            'room_name' => 'required|string',
            'room_type' => 'required|in:guest,suite,villa,specialty suite,accessible',
            'room_size' => 'required|numeric',
            'room_details' => 'required|string',
            'description' => 'nullable|string',
            'capacity' => 'required|integer',
            'price_per_night' => 'required|numeric',
            'availability_status' => 'required|in:available,booked,maintenance',
            'room_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Handle multiple images
        ]);

        // Handle image uploads and store them individually
        $imagePaths = [];
        if ($request->hasFile('room_images')) {
            foreach ($request->file('room_images') as $index => $image) {
                $imagePaths[$index] = $image->store('room_images', 'public'); // Save each image in the public disk
            }
        }

        // Check if we have enough images to assign to room_image_1, room_image_2, room_image_3
        $roomImages = [
            'room_image_1' => $imagePaths[0] ?? null,
            'room_image_2' => $imagePaths[1] ?? null,
            'room_image_3' => $imagePaths[2] ?? null,
        ];

        // Create the new room entry
        Room::create([
            'room_number' => $validated['room_number'],
            'room_name' => $validated['room_name'],
            'room_type' => $validated['room_type'],
            'room_size' => $validated['room_size'],
            'room_details' => $validated['room_details'],
            'description' => $validated['description'],
            'capacity' => $validated['capacity'],
            'price_per_night' => $validated['price_per_night'],
            'availability_status' => $validated['availability_status'],
            'room_image_1' => $roomImages['room_image_1'],
            'room_image_2' => $roomImages['room_image_2'],
            'room_image_3' => $roomImages['room_image_3'],
        ]);

        return redirect()->route('room')->with('success', 'Room created successfully!');
    }

    // Display rooms
    public function index()
    {
        $rooms = Room::all(); // Fetch all rooms

        // Group rooms by room_type
        $groupedRooms = $rooms->groupBy('room_type');
    
        // Filter unique rooms by room_name
        $uniqueRooms = $rooms->unique('room_name');

        // Count unique rooms by room_name per type
        $guestRoomCount = $groupedRooms->has('guest') ? $groupedRooms['guest']->unique('room_name')->count() : 0;
        $suiteRoomCount = $groupedRooms->has('suite') ? $groupedRooms['suite']->unique('room_name')->count() : 0;
        $villaRoomCount = $groupedRooms->has('villa') ? $groupedRooms['villa']->unique('room_name')->count() : 0;
        $specialtyRoomCount = $groupedRooms->has('specialty suite') ? $groupedRooms['specialty suite']->unique('room_name')->count() : 0;
        
        $totalRoomCount = $uniqueRooms->count();

        return view('room', compact('groupedRooms', 'uniqueRooms', 'guestRoomCount', 'suiteRoomCount', 'villaRoomCount', 'specialtyRoomCount', 'totalRoomCount'));
    }

    // Additional methods for listing, showing, editing, etc.
    
}
