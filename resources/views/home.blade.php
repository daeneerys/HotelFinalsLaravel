@extends('layouts.app')

@section('TigerDen', 'Homepage')

@section('content')
<div id="default-carousel" class="relative w-full" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative h-96 overflow-hidden md:h-screen">
        <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/home_page_3.jpg') }}" alt="Picture 1" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/home_page_2.jpg') }}" alt="Picture 2" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/home_page_1.jpg') }}" alt="Picture 3" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/home_page_4.jpg') }}" alt="Picture 4" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
<div class="container mx-auto px-4 py-16">
    <div class="text-center font-poppins">
        <h1 class="text-4xl font-inter md:text-4xl font-bold mb-4">Welcome to TigerDen Luxury Hotel</h1>
        <h2 class="text-xl font-inter md:text-2xl font-light mb-4">An Exclusive Retreat in the Heart of the Jungle</h2>
        <p class="max-w-5xl text-sm mx-auto mb-8 text-gray-700">
            Escape to a realm of untamed beauty and opulence at TigerDen, where luxury meets the wild. Nestled deep within lush,
            emerald canopies, our resort offers a harmonious blend of sophistication and raw nature,
            inviting you to experience a stay unlike any other. From intricately designed suites inspired by the elegance of the jungle
            to serene pathways lined with exotic flora, every corner of TigerDen is a masterpiece crafted for relaxation and wonder.
            Here, adventure is always just a heartbeat away. Immerse yourself in the whispers of the jungle on a guided nature walk,
            rejuvenate your senses in our luxurious rainforest spa, or simply lose yourself in the serenity of our private verandas.
        </p>
    </div>
    <div class="mt-16 flex flex-col md:flex-row items-center justify-center text-center md:text-left">
        <img alt="Verdant Sanctuary" class="w-full md:w-2/5 md:h-80 shadow-lg mb-8 md:mb-0 md:mr-8 object-cover" src="{{ asset('images/home_page_4.jpg') }}" />
        <div class="md:w-1/2 max-w-lg">
            <h3 class="text-xl font-inter md:text-3xl font-light mb-4">
                Lion's Lair
            </h3>
            <p class="mb-4">
                Feel the majestic aura of the jungle king in this regal space. Warm tones and bold accents make it a perfect haven for relaxation.
            </p>
            <a class="text-jungle-green hover:underline mb-4 inline-block" href="#">Read more →</a>
            <div>
                <a href="{{route('book')}}" class="bg-jungle-green text-white py-2 px-3 rounded-md hover:bg-jungle-brown transition duration-300">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</div>
<div class="relative w-full h-80 bg-cover bg-bottom" style="background-image: url('images/home_dine.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 flex items-center justify-center w-full h-full text-center text-white">
        <div class="space-y-4">
            <h2 class="text-3xl font-bold font-inter">Dine in at TigerDen Luxury Hotel</h2>
            <p class="text-base w-192 font-poppins">
                Indulge in exquisite dining options during your stay at TigerDen Resort.
                Savor the serene ambiance of our Jungle Bistro, nestled amidst lush greenery,
                or enjoy vibrant flavors at our Oasis Lounge, where every bite feels like an escape into nature’s embrace.
            </p>
            <button  class="bg-white text-jungle-green py-2 px-6 rounded-md hover:bg-jungle-brown hover:text-white transition duration-300">
                <a href="{{ route ('dine') }}">Learn More</a>
            </button>
        </div>
    </div>
</div>
<div class="mt-5 flex mb-4 flex-col md:flex-row items-center justify-center text-center md:text-left p-10">
    <div class="md:w-1/2 max-w-lg mr-10">
        <h3 class="text-xl font-inter md:text-3xl font-light mb-4">
            Join the TigerDen Experience – Where Luxury Meets Tranquility
        </h3>
        <p class="mb-4">
            Immerse yourself in a world of elegance and serenity at TigerDen Luxury Hotel.
            Nestled amidst the lush jungle, our resort blends modern luxury with nature’s beauty,
            offering you a peaceful escape from the ordinary.
        </p>
        @guest
        <a href="{{ route ('login') }}" class="bg-jungle-green text-white ml-96 py-2 px-6 rounded-md hover:bg-jungle-brown transition duration-300">
            Sign in
        </a>
        @endguest
    </div>
    <img alt="Signin" class="w-full md:w-2/5 md:h-80 shadow-lg mb-8 md:mb-0 md:ml-8 object-cover object-[50%_30%]" src="{{ asset('images/home_signin.jpg') }}" />
</div>
<div class="text-center font-poppins p-10">
    <h1 class="text-4xl font-inter md:text-4xl font-bold mb-4">Instagram</h1>
    <p class="max-w-5xl text-sm mx-auto mb-4 text-gray-900"> Stay in the know about everything going on at @TigerDen during your stay!
    </p>
    <button class="bg-jungle-green text-white py-2 px-6 rounded-md hover:bg-jungle-brown transition duration-300">Follow us!</button>
</div>
@endsection