@extends('layouts.app')

@section('TigerDen', 'Reservation')

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/reservation.js')
</head>
<div class="container mx-auto mt-8 px-4 py-8">
</div>
<div class="container mx-auto w-5/6 mt-16 mb-16 p-4">
    <div class="container grid grid-cols-[60%,40%] gap-4 ">
        <div class="border-solid border-2 h-full border-black relative ">
            <div class="flex justify-center items-center p-4 border-b-2 border-black bg-jungle-green">
                <!-- Title -->
                <h3 class="text-lg font-poppins font-light text-center w-full text-white">Select your dates at TigerDen</h3>
            </div>
            <form id="reservation-form" action="/reserve" method="POST">
                @csrf
                <!-- Calendar Selection -->
                <div class="grid grid-cols-[1fr,1px,1fr] gap-0 px-4 h-full box-border overflow-hidden" id="calendar-container">
                    <div class="relative h-full">
                        <div id="calendar1" class="h-auto"></div>
                        <button id="prev-month" class="absolute top-0 left-0 text-lg font-bold text-gray-700 hover:text-gray-900 m-4">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    </div>

                    <!-- Vertical Separator -->
                    <div class="border-l-2 border-black h-[84.5%]"></div>

                    <div class="relative h-auto">
                        <div id="calendar2" class="h-auto"></div>
                        <button id="next-month" class="absolute top-0 right-0 text-lg font-bold text-gray-700 hover:text-gray-900 m-4">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
        </div>
        <div class="w-full max-w-md font-inter ">
            <div class="grid grid-cols-2 border border-black">
                <div class="border-r border-black">
                    <div class="bg-jungle-green text-white text-center py-2">Arrival</div>
                    <div class="flex flex-col items-center justify-center py-8 h-32">
                        <div class="arrival-day text-4xl font-bold" id="arrival-date"></div>
                        <div class="arrival-month text-lg" id="arrival-month"></div>
                    </div>
                </div>
                <!-- Check In Date Input -->
                <input type="hidden" id="check-in-date" name="checkInDate" value="">
                <div>
                    <div class="bg-jungle-green text-white text-center py-2">Departure</div>
                    <div class="flex flex-col items-center justify-center py-8 h-32">
                        <div class="departure-day text-4xl font-bold" id="departure-date"></div>
                        <div class="departure-month text-lg" id="departure-month"></div>
                    </div>
                    <!-- Check Out Date Input -->
                    <input type="hidden" id="check-out-date" name="checkOutDate" value="">
                </div>
            </div>
            <div class="border border-black mt-4">
                <!-- Room Dropdown -->
                <div class="relative w-full">
                    <!-- Dropdown Trigger -->
                    <button
                        id="room-dropdown-button"
                        class="w-full border border-gray-300 text-gray-700 py-3 px-4 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-jungle-green"
                        >
                        <span id="room-selected-option" class="text-xs">Select a room</span>
                        <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown List -->
                    <div
                        id="room-dropdown-menu"
                        class="absolute text-xs hidden z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-md overflow-y-auto max-h-40">
                        <!-- Options will be rendered here -->
                    </div>
                </div>
                <input type="hidden" id="selected-room" name="room" value="">
            </div>
            <div class="border border-black mt-4">
                <!-- Amenity Dropdown -->
                <div class="relative w-full">
                    <!-- Dropdown Trigger -->
                    <button
                        id="amenity-dropdown-button"
                        class="w-full border border-gray-300 text-gray-700 py-3 px-4 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-jungle-green"
                        >
                        <span id="amenity-selected-option" class="text-xs">Select an amenity</span>
                        <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown List -->
                    <div
                        id="amenity-dropdown-menu"
                        class="absolute text-xs hidden z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-md overflow-y-auto max-h-40">
                        <!-- Options will be rendered here -->
                    </div>
                    <input type="hidden" id="selected-amenity" name="amenity" value="">
                </div>
            </div>
            <span class="text-xs w-4/5 ml-2 text-gray-500 mt-2 block">Please note: Reserving a room includes complimentary
                access to the riverside pool as part of your amenities.
            </span>
            <button id="check-availability-btn" class="w-full mt-4 text-xs border font-poppins font-bold tracking-wider border-gray-900 hover:bg-jungle-green hover:text-white  py-3 px-4 text-center justify-center">
                Check Availability
            </button>
        </div>
        <!-- Modal -->
        <div id="availability-modal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white w-80 p-6 rounded-lg shadow-lg">
                <div id="modal-content" class="text-center">
                    <p id="modal-message" class="text-lg font-bold">Loading...</p>
                </div>
                <button type = "submit" id="submit-modal-btn" class="mt-4 px-4 py-2 text-sm bg-jungle-green text-white rounded-lg hover:bg-green-700">
                    Reserve
                </button>
                <button type = "button" id="close-modal-btn" class="mt-4 px-4 py-2 text-sm bg-jungle-green text-white rounded-lg hover:bg-green-700">
                    Close
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
<div class="container mx-auto mt-8 px-4 py-8">
</div>

@endsection