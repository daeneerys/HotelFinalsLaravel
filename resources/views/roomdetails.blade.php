@extends('layouts.app')

@section('TigerDen', 'RoomDetails')

@section('content')
<div class="container mx-auto mt-2 px-4 py-8">
</div>
<div class="container w-full h-28 bg-jungle-green border-t-2 border-solid border-white text-center flex flex-col justify-center items-center">
    <h6 class="font-inter text-white text-base">Accomodations</h6>
    <!--Room Name -->
    <h2 class="text-white text-4xl font-poppins tracking-widest font-black mt-2 uppercase">{{ $room_name }}</h2>
</div>
<div class="container text-center flex flex-col justify-center items-center">
    <img src="{{ asset($room_image_1) }}" class="w-full h-128 object-cover" alt="{{ $room_name }}">
</div>
<div class="container w-full h-44 bg-jungle-green text-center flex flex-col justify-center items-center">
    <!--Room Name -->
    <p class="text-white text-base w-2/5 font-poppins font-light">{{ $description }}</p>
    <button class="bg-white font-poppins font-normal text-lg px-4 py-1 mt-4 hover:bg-gray-100">BOOK NOW</button>
</div>
<div class="container w-3/5 mt-16 mx-auto mb-16">
    <h3 class="uppercase font-poppins font-extralight tracking-widest text-center text-3xl mb-16 ">Details</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-8">
        <!-- Bed -->
        <div class="border-t-2 border-solid border-gray-700">
            <div class="flex items-center mb-4 mt-8">
                <i class="fas fa-bed mr-4"></i>
                <h6 class="font-poppins uppercase tracking-wider font-black">BEDS</h6>
            </div>
            <p class="font-poppins font-light text-sm ml-9">{{ $room_details }}</p>
        </div>
        <!-- Capacity -->
        <div class="border-t-2 border-solid border-gray-700">
            <div class="flex items-center mb-4 mt-8">
                <i class="fas fa-users mr-4">
                </i>
                <h6 class="font-poppins uppercase tracking-wider font-black">CAPACITY</h6>
            </div>
            <p class="font-poppins font-light text-sm ml-9">Accomodates {{ $capacity }} guest</p>
        </div>
        <!-- Room Size -->
        <div class="border-t-2 border-solid border-gray-700">
            <div class="flex items-center mb-4 mt-8">
                <i class="fas fa-ruler-combined mr-4"></i>
                <h6 class="font-poppins uppercase tracking-wider font-black">Room size</h6>
            </div>
            <!-- Convert the room size to meters -->
            @php
            $roomSizeInMeters = $room_size * 0.092903;
            @endphp
            <p class="font-poppins font-light text-sm ml-9">Ideal for your comfort, with {{ $room_size }} sq. ft.
                / {{ number_format($roomSizeInMeters, 2) }} m² of space
            </p>
        </div>
        <div class="border-t-2 border-solid border-gray-700">
            <div class="flex items-center mb-4 mt-8">
                <i class="fas fa-tag mr-4"></i>
                <h6 class="font-poppins uppercase tracking-wider font-black">PRICE</h6>
            </div>
            <p class="font-poppins font-light text-sm ml-9"> Enjoy a luxurious stay for only <span class="font-bold">PHP {{ $price_per_night }}</span> per night.
                Experience the ultimate comfort and relaxation!</p>
        </div>
    </div>
</div>
@endsection