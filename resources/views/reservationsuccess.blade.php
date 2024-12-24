@extends('layouts.app')

@section('TigerDen', 'Reservation Success')

@section('content')
<div class="h-screen flex items-center justify-center">
    <div class="bg-white p-10 py-12 text-center">
        <img alt="Green checkmark icon with a decorative background" class="mx-auto mb-4 h-16 w-16" src="{{asset('images/success.png')}}" />
        <h1 class="text-2xl font-semibold text-gray-800 mb-2">
            Your Reservation Booked Successfully!
        </h1>
        <p class="text-gray-600 mb-6">
            We have sent your booking information to your email address.
        </p>
        <div class="flex justify-center space-x-8 text-gray-700">
            <div>
                <p class="font-medium">
                    Service:
                </p>
                <p>
                    Michal Yoga Class
                </p>
            </div>
            <div>
                <p class="font-medium">
                    Date &amp; Time:
                </p>
                <p>
                    December 29, 2021 | 9:00 AM
                </p>
            </div>
            <div>
                <p class="font-medium">
                    Customer Name:
                </p>
                <p>
                    Mary Christy
                </p>
            </div>
        </div>
        <button class="py-3 px-6 mt-6 bg-jungle-green text-white rounded-md">Go to Home</button>
    </div>
</div>
@endsection