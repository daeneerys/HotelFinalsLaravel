@extends('layouts.app')

@section('TigerDen', 'Room')

@section('content')
<head>
@vite('resources/js/room.js')
</head>
<div class="container mx-auto mt-2 px-4 py-8">
</div>
<div class="container w-full h-28 bg-jungle-green border-t-2 border-solid border-white text-center flex flex-col justify-center items-center mb-8">
    <h6 class="font-inter text-white text-2xl">Manila, Philippines</h6>
    <h2 class="text-white text-4xl font-poppins tracking-widest font-black">ACCOMMODATION</h2>
</div>
<div class="container text-center flex flex-col justify-center items-center mb-8">
    <p class="w-2/5 font-xs font-poppins tracking-wide font-light">At TigerDen Luxury Hotel, we offer an exquisite range of accommodations
        designed to elevate your stay into an unforgettable experience.
        Relish breathtaking views of lush greenery from our garden-facing rooms,
        or unwind in the serene ambiance of our premium suites featuring expansive balconies and modern amenities. Whether
        you're looking for a tranquil escape or a lavish getaway,
        TigerDen Luxury Hotel provides the perfect blend of
        opulence and thoughtful design to ensure your stay is nothing short of extraordinary.
    </p>
</div>
<div class="container mx-auto w-4/5 font-inter mb-8 border-b-2 border-gray-400">
    <!-- Tabs Navigation -->
    <div class="w-full mx-auto flex pb-3">
        <!-- View All Tab -->
        <button
            id="viewAllRooms"
            class="tab-button text-xs font-medium text-gray-800 border-r-2 border-gray-400 hover:text-jungle-brown py-2 pr-5"
            data-tab="all">
            View All ({{ $totalRoomCount }})
        </button>
        <div class="flex space-x-2 ml-7 flex-grow">
            <!-- Guest Rooms Tab -->
            <button
                id="guestRoomsTab"
                class="tab-button text-xs font-medium text-gray-800 hover:text-jungle-brown py-2 px-4"
                data-tab="guest">
                Guest Rooms ({{ $guestRoomCount }})
            </button>

            <!-- Suites Tab -->
            <button id="suitesTab"
                class="tab-button text-xs font-medium text-gray-800 hover:text-jungle-brown py-2 px-4"
                data-tab="suites">
                Suites ({{ $suiteRoomCount }})
            </button>

            <!-- Villas Tab -->
            <button id="villasTab"
                class="tab-button text-xs font-medium text-gray-800 hover:text-jungle-brown py-2 pxp-4"
                data-tab="villas">
                Villas ({{ $villaRoomCount }})
            </button>

            <!-- Specialty Suites Tab -->
            <button id="specialtySuitesTab"
                class="tab-button text-xs font-medium text-gray-800 hover:text-jungle-brown py-2 px-4"
                data-tab="specialty">
                Specialty Suites ({{ $specialtyRoomCount }})
            </button>

        </div>
    </div>
</div>

<div class="container mx-auto w-4/5 font-inter mb-16">
    <div id="guest_rooms">
        <x-guestroom :uniqueRooms="$uniqueRooms" />
    </div>
    <div id = "suites_rooms">
        <x-suiteroom :uniqueRooms="$uniqueRooms" />
    </div>
    <div id = "villa_rooms">
        <x-villaroom :uniqueRooms="$uniqueRooms" />
    </div>
    <div id = "specialty_rooms">
        <x-specialtyroom :uniqueRooms="$uniqueRooms" />
    </div>
</div>
</div>
</div>
@endsection