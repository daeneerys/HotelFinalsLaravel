@extends('layouts.app')

@section('TigerDen', 'Reservation Success')

@section('content')
<div class="h-screen flex items-center justify-center">
    <div class="bg-white p-10 py-12 text-center">
        <img alt="Green checkmark icon with a decorative background" class="mx-auto mb-4 h-16 w-16" src="{{ asset('images/success.png') }}" />
        <h1 class="text-2xl font-semibold text-gray-800 mb-2">
            Your Reservation Booked Successfully!
        </h1>
        <p class="text-gray-600 mb-6">
            We have sent your booking information to your email address.
        </p>
        <div class="flex justify-center space-x-8 text-gray-700 mb-8">
            <div>
                <p class="font-medium">Customer Name:</p>
                <p>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
            </div>
            <div>
                <p class="font-medium">Room Name:</p>
                <p>{{ $reservation->room->room_name ?? 'Room not found' }}</p>
            </div>
            <div>
                <p class="font-medium">Check-In Date:</p>
                <p>{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('F j, Y') }} | 2:00 PM</p>
            </div>
            <div>
                <p class="font-medium">Check-Out Date:</p>
                <p>{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('F j, Y') }} | 12:00 PM</p>
            </div>
        </div>
        <a href="{{ route('home') }}" class="py-3 px-6 mt-6 bg-jungle-green text-white rounded-md">Go to Home</a>
    </div>
</div>
@endsection