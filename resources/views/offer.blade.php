@extends('layouts.app')

@section('TigerDen', 'Offers')

@section('content')
<div class="container mx-auto px-4 py-8">
</div>
<h1 class="text-5xl font-poppins font-bold text-center mt-8 mb-4">
    Special Offers
</h1>
<p class="text-2xl text-gray-700 font-inter text-center mt-4">
    Experience TigerDen charm at advantageous rates
</p>
<div class="grid grid-cols-1 md:grid-cols-3 mt-8 mb-16">
    <!-- First Card -->
    <div class="text-center">
        <img alt="Offer Picture 1" class="w-4/5 h-auto mx-auto" src="{{ asset('images/offer_1.jpg') }}" />
        <h2 class="text-2xl font-poppins font-semibold mt-4">
            Christmas &amp; New Year Sale
        </h2>
        <p class="text-gray-600 mt-2 font-inter text-base">
            Save up to 50% OFF &amp; enjoy extra perks!
        </p>
        <a class="text-jungle-green mt-2 inline-block hover:underline" href="#">
            Read more →
        </a>
        <div class="mt-4">
            <button class="bg-jungle-green text-white py-2 px-4 rounded-md hover:bg-jungle-brown transition duration-300">
                BOOK NOW
            </button>
        </div>
    </div>
    <!-- Second Card -->
    <div class="text-center">
        <img alt="Offer Picture 2" class="w-4/5 h-auto mx-auto" src="{{ asset('images/offer_2.jpg') }}" />
        <h2 class="text-2xl font-poppins font-semibold mt-4">
            Stay More, Save More
        </h2>
        <p class="text-gray-600 mt-2 font-inter text-base">
            Stay longer and save up to 50% on your stay!
        </p>
        <a class="text-jungle-green mt-2 inline-block hover:underline" href="#">
            Read more →
        </a>
        <div class="mt-4">
            <button class="bg-jungle-green text-white py-2 px-4 rounded-md hover:bg-jungle-brown transition duration-300">
                BOOK NOW
            </button>
        </div>
    </div>
    <!-- Third Card -->
    <div class="text-center">
        <img alt="Offer Picture 2" class="w-4/5 h-auto mx-auto" src="{{ asset('images/offer_3.jpg') }}" />
        <h2 class="text-2xl font-poppins font-semibold mt-4">
            Flex Early Bird Offer
        </h2>
        <p class="text-gray-600 mt-2 font-inter text-base ">
            Book 30 days in advance and save 20% on stays of 3+ days.
        </p>
        <a class="text-jungle-green mt-2 inline-block hover:underline" href="#">
            Read more →
        </a>
        <div class="mt-4">
            <button class="bg-jungle-green text-white py-2 px-4 rounded-md hover:bg-jungle-brown transition duration-300">
                BOOK NOW
            </button>
        </div>
    </div>
</div>
<div class="text-center mb-8 mt-8">
    <h1 class="text-2xl font-inter-normal">Stay up to date with special offers and events</h1>
</div>
<div class="bg-gray-200 mx-auto p-8 rounded-lg shadow-lg w-full max-w-4xl mb-16">
    <form class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 font-poppins">
        <div>
            <label for="first-name" class="block text-sm font-medium text-jungle-green">First Name <span class="text-jungle-green">*</span></label>
            <input type="text" id="first-name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label for="last-name" class="block text-sm font-medium text-jungle-green">Last Name <span class="text-jungle-green">*</span></label>
            <input type="text" id="last-name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label for="telephone" class="block text-sm font-medium text-jungle-green">Telephone <span class="text-jungle-green">*</span></label>
            <input type="text" id="telephone" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-jungle-green">Email <span class="text-jungle-green">*</span></label>
            <input type="email" id="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div class="col-span-1 md:col-span-2 lg:col-span-4 flex justify-center mt-4">
            <button type="submit" class="bg-white text-black font-normal tracking-wider py-2 px-16 border border-gray-300 rounded-md shadow-sm hover:bg-gray-100">SEND</button>
        </div>
    </form>
</div>
@endsection