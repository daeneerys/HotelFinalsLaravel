@extends('layouts.app')

@section('TigerDen', 'Manage Rooms')  <!-- Page Title -->

@section('content')
<style>
    body {
        padding-top: 100px; /* Adjust as needed to clear the blocked content */
    }
</style>
<div class="flex flex-col items-center min-h-screen">
    <!-- Success message -->
    @if (session('status'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    <!-- Manage Rooms Header, Button, and Search Bar -->
    <div class="w-3/4 flex items-center justify-between mb-6">
        <h2 class="text-3xl font-semibold text-gray-700">Manage Rooms</h2>
        <a href="{{ route('admin.addroom') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
            Add New Room
        </a>
    </div>

    <!-- Search Bar -->
    <div class="w-3/4 mb-6">
        <form action="{{ route('admin.managerooms') }}" method="GET" class="flex justify-between">
            <input 
                type="text" 
                name="search" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md" 
                placeholder="Search Rooms..." 
                value="{{ request()->get('search') }}"
            >
            <button type="submit" class="ml-2 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Search
            </button>
        </form>
    </div>

    <!-- Rooms Table -->
    <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-lg w-3/4">
        <h3 class="text-xl font-semibold mb-4 text-center">All Rooms</h3>
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2 text-left">Room Number</th>
                    <th class="border px-4 py-2 text-left">Room Name</th>
                    <th class="border px-4 py-2 text-left">Room Type</th>
                    <th class="border px-4 py-2 text-left">Room Size</th>
                    <th class="border px-4 py-2 text-left">Details</th>
                    <th class="border px-4 py-2 text-left">Price</th>
                    <th class="border px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td class="border px-4 py-2">{{ $room->room_number }}</td>
                        <td class="border px-4 py-2">{{ $room->room_name }}</td>
                        <td class="border px-4 py-2">{{ $room->room_type }}</td>
                        <td class="border px-4 py-2">{{ $room->room_size }}</td>
                        <td class="border px-4 py-2">{{ $room->room_details }}</td>
                        <td class="border px-4 py-2">${{ $room->price_per_night }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.editRoom', $room->room_id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-12 mb-12 w-3/4">
        <div class="flex justify-center">
            {{ $rooms->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
