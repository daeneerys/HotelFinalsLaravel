@extends('layouts.app')

@section('TigerDen', 'My Reservations')

@section('content')

<div class="container mx-auto mt-8 px-4 py-8"></div>
<div class="container mx-auto w-4/5 p-4 min-h-dvh">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold">
            My Reservations
        </h1>
    </div>

    @if($reservations->isEmpty())
    <div class="bg-white p-4 rounded-lg shadow-md text-center">
        <p class="text-gray-600">You have no reservations yet.</p>
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
                    src="{{ $reservation->room->room_image_1 ?? 'default-image.jpg' }}" />
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
                @if($reservation->reservation_status === 'reserved')
                <!-- Cancel Button -->
                <button
                    type="button"
                    class="bg-red-500 text-white py-2 px-4 rounded-lg"
                    onclick="openModal('modal-{{ $reservation->reservation_id }}')">
                    Cancel Reservation
                </button>

                <!-- Confirmation Modal -->
                <div
                    id="modal-{{ $reservation->reservation_id }}"
                    class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">
                            Are you sure?
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Cancelling this reservation will refund only 50% of your payment.
                        </p>
                        <div class="flex justify-end space-x-4">
                            <!-- Cancel Button -->
                            <button
                                type="button"
                                class="bg-gray-300 text-gray-800 py-2 px-4 rounded-lg"
                                onclick="closeModal('modal-{{ $reservation->reservation_id }}')">
                                Cancel
                            </button>
                            <!-- Submit Button -->
                            <form action="{{ route('reservation.update', $reservation->reservation_id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="reservation_status" value="Pending">
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg">
                                    Confirm
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <button class="bg-gray-300 text-gray-600 py-2 px-4 rounded-lg" disabled>
                    No Action Available
                </button>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
<div class="container mx-auto mt-8 px-4 py-8"></div>

<script>
    function openModal(reservation_id) {
        document.getElementById(reservation_id).classList.remove('hidden');
        document.getElementById(reservation_id).classList.add('flex');
    }

    function closeModal(reservation_id) {
        document.getElementById(reservation_id).classList.add('hidden');
        document.getElementById(reservation_id).classList.remove('flex');
    }
</script>

@endsection