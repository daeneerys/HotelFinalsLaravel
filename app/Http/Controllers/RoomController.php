<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    // Store a newly created room
    public function create()
{
    return view('admin.createroom'); // Replace with the actual Blade file for the add room form
}
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
        'room_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000', // Handle multiple images
    ]);

    $imagePaths = [];
    if ($request->hasFile('room_images')) {
        foreach ($request->file('room_images') as $index => $image) {
            $imagePaths[$index] = $image->store('images/room', 'public'); // Save each image in the public disk
        }
    }
    
    $roomImages = [
        'room_image_1' => $imagePaths[0] ?? 'default_image_path.jpg',
        'room_image_2' => $imagePaths[1] ?? 'default_image_path.jpg',
        'room_image_3' => $imagePaths[2] ?? 'default_image_path.jpg',
    ];
    
    // Then insert into the database
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

    return redirect()->route('admin.managerooms')->with('status', 'Room created successfully!');
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

    public function roomdetails($room_name)
    {
        // Replace dashes back to spaces
        $room_name = str_replace('-', ' ', $room_name);

        // Fetch a single room by room_name
        $room = Room::where('room_name', $room_name)->firstOrFail();

        return view('roomdetails', [
            'room_name' => $room->room_name,
            'room_type' => $room->room_type,
            'room_size' => $room->room_size,
            'description' => $room->description,
            'capacity' => $room->capacity,
            'price_per_night' => $room->price_per_night,
            'room_details' => $room->room_details,
            'room_image_1' => $room->room_image_1,
        ]);
    }

    public function checkAvailability(Request $request)
    {
        // Get the room_name from the request
        $roomName = $request->input('room_name');

        // Find all rooms with the same room name
        $rooms = Room::where('room_name', $roomName)->get();

        // Check if any of the rooms are available
        $isAvailable = $rooms->contains(function ($room) {
            return $room->availability_status === 'available';
        });

        if ($isAvailable) {
            return response()->json([
                'available' => true,
                'message' => 'At least one room with this name is available!'
            ]);
        } else {
            return response()->json([
                'available' => false,
                'message' => 'Sorry, all rooms with this name are unavailable.'
            ]);
        }
    }
    public function managerooms(Request $request)
    {
        $query = Room::query();
    
        // Check if there's a search query
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('room_number', 'like', "%{$search}%")
                  ->orWhere('room_name', 'like', "%{$search}%")
                  ->orWhere('room_type', 'like', "%{$search}%")
                  ->orWhere('room_details', 'like', "%{$search}%");
        }
    
        // Fetch rooms with pagination
        $rooms = $query->paginate(10);
    
        return view('admin.manageRooms', compact('rooms'));
    }

    //edit room 

    // Display the edit form with the existing room data
    public function edit($room_id)
    {
        // Find the room by its ID
        $room = Room::findOrFail($room_id);

        return view('admin.editRoom', compact('room'));
    }

    // Update the room details
    public function update(Request $request, $room_id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room_id . ',room_id',
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

        // Find the room by ID
        $room = Room::findOrFail($room_id);

        // Handle image uploads and store them individually
        $imagePaths = [];
        if ($request->hasFile('room_images')) {
            foreach ($request->file('room_images') as $index => $image) {
                $imagePaths[$index] = $image->store('room_images', 'public'); // Save each image in the public disk
            }
        }

        // Check if we have enough images to assign to room_image_1, room_image_2, room_image_3
        $roomImages = [
            'room_image_1' => $imagePaths[0] ?? $room->room_image_1,
            'room_image_2' => $imagePaths[1] ?? $room->room_image_2,
            'room_image_3' => $imagePaths[2] ?? $room->room_image_3,
        ];

        // Update the room data
        $room->update([
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

        return redirect()->route('admin.managerooms')->with('status', 'Room updated successfully!');
    }

}
