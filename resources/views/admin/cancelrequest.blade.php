@extends('layouts.app')

@section('TigerDen', 'Admin Cancel Request')

@section('content')

<div class="container mx-auto mt-4 px-4 py-4"></div>
<div class="container w-4/5  mx-auto mt-8 px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Pending Cancellation Requests</h1>

    @if($reservations->isEmpty())
    <div class="bg-white mx-auto p-4 rounded-lg shadow-md text-center">
        <p class="text-gray-600">There are no pending cancellation requests.</p>
    </div>
    @else
    @foreach($reservations as $reservation)
    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
        <div class="grid grid-cols-5 gap-4 items-center">
            <!-- Room Details -->
            <div class="col-span-2 flex items-center space-x-4">
                <img
                    alt="{{ $reservation->room->name }}"
                    class="w-24 h-24 rounded-lg"
                    src="{{ $reservation->room->room_image_1 ? asset($reservation->room->room_image_1) : asset('default-image.jpg') }}" />
                <div>
                    <p class="font-semibold">
                        Booking #{{ $reservation->reservation_id }}: {{ $reservation->room->name }}
                    </p>
                    <p>
                        Room: {{ $reservation->room->room_name ?? 'N/A' }} - {{$reservation->room->room_id}}
                    </p>
                    <p>
                        Amenity: {{ $reservation->amenity->amenity_name ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <!-- Reservation Status -->
            <div class="text-purple-600 font-semibold">
                Status: {{ ucfirst($reservation->reservation_status) }}
            </div>

            <!-- Reservation Period -->
            <div>
                {{ \Carbon\Carbon::parse($reservation->check_in_date)->format('m-d-Y') }} to
                {{ \Carbon\Carbon::parse($reservation->check_out_date)->format('m-d-Y') }}
            </div>

            <!-- Action Buttons -->
            <div>
                <!-- Confirm Cancellation Button -->
                <form action="{{ route('reservation.confirmCancel', $reservation->reservation_id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg">
                        Confirm Cancellation
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>

@endsection