@extends('layouts.app')

@section('TigerDen', 'Reservation')

@section('content')


<div class="container mx-auto mt-8 px-4 py-8">
</div>
<div class="container mx-auto w-4/5 p-4 min-h-dvh">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold">
            My Reservations
        </h1>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
        <div class="flex space-x-4">
            <input class="flex-grow p-2 border rounded-lg" placeholder="Search by listing name." type="text" />
            <button class="bg-green-700 text-white py-2 px-4 rounded-lg">
                Search
            </button>
        </div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <!-- Grid Header -->
        <div class="grid grid-cols-5 gap-4 mb-4">
            <div class="col-span-2 font-semibold">
                Property
            </div>
            <div class="font-semibold">
                Status
            </div>
            <div class="font-semibold">
                Period
            </div>
            <div class="font-semibold">
                Action
            </div>
        </div>
        <!-- Grid Row -->
        <div class="grid grid-cols-5 gap-4 items-center">
            <div class="col-span-2 flex items-center space-x-4">
                <img alt="Interior of a bungalow with modern furniture" class="w-24 h-24 rounded-lg" src="https://storage.googleapis.com/a1aa/image/enfpBEHWQVkPNUNFZzeJjRs8aifmdaGAskVbyDp3pqAF7a3PB.jpg" />
                <div>
                    <p class="font-semibold">
                        Booking #37986: Quercianella Bungalow
                    </p>
                    <p>
                        Amenity: Pool
                    </p>
                </div>
            </div>
            <div class="text-purple-600 font-semibold">
                Request Pending
            </div>
            <div>
                06-03-22 to 07-03-22
            </div>
            <div>
                <button class="bg-red-500 text-white py-2 px-4 rounded-lg">
                    Cancel Booking Request
                </button>
            </div>
        </div>
    </div>
</div>
<div class="container mx-auto mt-8 px-4 py-8">
</div>

@endsection