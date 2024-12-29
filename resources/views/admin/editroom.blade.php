@extends('layouts.app')

@section('TigerDen', 'Edit Room')  <!-- Page Title -->

@section('content')
<div class="container mx-auto p-8">
    <!-- Edit Room Form -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold mb-4">Edit Room - {{ $room->room_name }}</h3>

        <!-- Display Success or Error Messages -->
        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Room Edit Form -->
        <form action="{{ route('admin.updateRoom', $room->room_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Room Number -->
            <div class="mb-4">
                <label for="room_number" class="block text-lg font-medium">Room Number</label>
                <input type="text" id="room_number" name="room_number" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('room_number', $room->room_number) }}" required>
            </div>

            <!-- Room Name -->
            <div class="mb-4">
                <label for="room_name" class="block text-lg font-medium">Room Name</label>
                <input type="text" id="room_name" name="room_name" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('room_name', $room->room_name) }}" required>
            </div>

            <!-- Room Type -->
            <div class="mb-4">
                <label for="room_type" class="block text-lg font-medium">Room Type</label>
                <select id="room_type" name="room_type" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    <option value="guest" {{ old('room_type', $room->room_type) == 'guest' ? 'selected' : '' }}>Guest</option>
                    <option value="suite" {{ old('room_type', $room->room_type) == 'suite' ? 'selected' : '' }}>Suite</option>
                    <option value="villa" {{ old('room_type', $room->room_type) == 'villa' ? 'selected' : '' }}>Villa</option>
                    <option value="specialty suite" {{ old('room_type', $room->room_type) == 'specialty suite' ? 'selected' : '' }}>Specialty Suite</option>
                    <option value="accessible" {{ old('room_type', $room->room_type) == 'accessible' ? 'selected' : '' }}>Accessible</option>
                </select>
            </div>

            <!-- Room Size -->
            <div class="mb-4">
                <label for="room_size" class="block text-lg font-medium">Room Size</label>
                <input type="number" id="room_size" name="room_size" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('room_size', $room->room_size) }}" required>
            </div>

            <!-- Room Details -->
            <div class="mb-4">
                <label for="room_details" class="block text-lg font-medium">Room Details</label>
                <textarea id="room_details" name="room_details" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>{{ old('room_details', $room->room_details) }}</textarea>
            </div>

            <!-- Description (Optional) -->
            <div class="mb-4">
                <label for="description" class="block text-lg font-medium">Description (Optional)</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-md">{{ old('description', $room->description) }}</textarea>
            </div>

            <!-- Capacity -->
            <div class="mb-4">
                <label for="capacity" class="block text-lg font-medium">Capacity</label>
                <input type="number" id="capacity" name="capacity" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('capacity', $room->capacity) }}" required>
            </div>

            <!-- Price per Night -->
            <div class="mb-4">
                <label for="price_per_night" class="block text-lg font-medium">Price per Night</label>
                <input type="number" id="price_per_night" name="price_per_night" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('price_per_night', $room->price_per_night) }}" required>
            </div>

            <!-- Availability Status -->
            <div class="mb-4">
                <label for="availability_status" class="block text-lg font-medium">Availability Status</label>
                <select id="availability_status" name="availability_status" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    <option value="available" {{ old('availability_status', $room->availability_status) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="booked" {{ old('availability_status', $room->availability_status) == 'booked' ? 'selected' : '' }}>Booked</option>
                    <option value="maintenance" {{ old('availability_status', $room->availability_status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <!-- Room Images (Optional) -->
            <div class="mb-4">
                <label for="room_images" class="block text-lg font-medium">Room Images (Optional)</label>
                <input type="file" id="room_images" name="room_images[]" class="w-full px-4 py-2 border border-gray-300 rounded-md" multiple>
                <small class="text-gray-500">Leave empty to keep current images.</small>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">
                Update Room
            </button>
        </form>
    </div>
</div>
@endsection
