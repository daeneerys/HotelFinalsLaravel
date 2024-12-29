@extends('layouts.app')

@section('TigerDen', 'View Reservations')  <!-- Page Title -->

@section('content')
<div class="container mx-auto p-8">
    <!-- Dashboard Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-semibold text-gray-700">View Reservations</h2>
    </div>

    <!-- Reservations List -->
    <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold mb-4">All Reservations</h3>
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Reservation ID</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Room</th>
                    <th class="px-4 py-2">Amenity</th>
                    <th class="px-4 py-2">Check-in Date</th>
                    <th class="px-4 py-2">Check-out Date</th>
                    <th class="px-4 py-2">Total Price</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td class="border px-4 py-2">{{ $reservation->reservation_id }}</td>
                        <td class="border px-4 py-2">{{ $reservation->user->first_name }} {{ $reservation->user->last_name }}</td>
                        <td class="border px-4 py-2">{{ $reservation->room->room_name }}</td>
                        <td class="border px-4 py-2">{{ $reservation->amenity->amenity_name }}</td>
                        <td class="border px-4 py-2">{{ $reservation->check_in_date }}</td>
                        <td class="border px-4 py-2">{{ $reservation->check_out_date }}</td>
                        <td class="border px-4 py-2">${{ number_format($reservation->total_price, 2) }}</td>
                        <td class="border px-4 py-2">
                            <span class="px-2 py-1 text-white rounded {{ $reservation->reservation_status == 'confirmed' ? 'bg-green-600' : 'bg-red-600' }}">
                                {{ ucfirst($reservation->reservation_status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
