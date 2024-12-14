@extends('layouts.app')

@section('TigerDen', 'Dine')

@section('content')

<head>
    @vite('resources/js/dine.js')
</head>
<div class="container mx-auto mt-2 px-4 py-8">
</div>
<div class="container mx-auto w-4/5 mt-2 px-4 py-8">
    <h1 class="font-poppins font-extralight text-5xl tracking-wide ml-5 w-4/5">CULTURAL DINING <br> EXPERIENCES</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <div class="mx-auto my-auto">
            <h4 class="font-poppins font-light text-2xl text-gray-500 uppercase">
                Jungle Riverfront Bar and Lounge
            </h4>
        </div>
        <div class="mx-auto my-auto w-4/5">
            <p class="font-inter font-thin text-sm ml-16 text-gray-400">
                Savor authentic Filipino family recipes, indulge in the creations of a renowned chef,
                or treat yourself to decadent pastries and craft cocktails, all with the majestic UST as a backdrop
                at our riverfront restaurant, nestled within the heart of our luxurious jungle-themed hotel.
                Immerse yourself in the flavors of the Philippines while enjoying the stunning views of the lush jungle and tranquil river.
            </p>
        </div>
    </div>
    <div class="container mt-16 px-4 py-8">
        <img alt="Dine Picture 1" class="w-4/5 h-auto" src="{{ asset('images/dine_image1.jpg') }}" />
    </div>
</div>
<div class="container mx-auto w-4/5 mt-16 px-2 py-2 mb-8">
    <div class="flex font-poppins space-x-2 items-center justify-center flex-grow">
        <button
            id="treetop-feast"
            class="dine-tab-button text-sm font-medium text-gray-800 hover:text-jungle-brown py-2 px-4"
            data-dinetab="treetop-feast">
            Treetop Feast
        </button>

        <button id="wild-orchid"
            class="dine-tab-button text-sm font-medium text-gray-800 hover:text-jungle-brown py-2 px-4"
            data-dinetab="wild-orchid">
            The Wild Orchid
        </button>

        <button id="vines-views"
            class="dine-tab-button text-sm font-medium text-gray-800 hover:text-jungle-brown py-2 pxp-4"
            data-dinetab="vines-views">
            Vines & Views
        </button>

        <button id="mist-mango"
            class="dine-tab-button text-sm font-medium text-gray-800 hover:text-jungle-brown py-2 px-4"
            data-dinetab="mist-mango">
            Mist & Mango
        </button>

        <button id="wildleaf-dining"
            class="dine-tab-button text-sm font-medium text-gray-800 hover:text-jungle-brown py-2 px-4"
            data-dinetab="wildleaf-dining">
            Wildleaf Dining
        </button>
    </div>
    <div class="container mt-4">
        <div class = "dine-tab-content treetop-feast-container hidden">
            <x-treetopfeast />
        </div>
        <div class = "dine-tab-content wild-orchid-container hidden">
            <x-wildorchid />
        </div>
        <div class = "dine-tab-content mist-mango-container hidden">
            <x-mistandmango />
        </div>
        <div class = "dine-tab-content vines-views-container hidden">
            <x-vinesandview />
        </div>
        <div class = "dine-tab-content wildleaf-dining-container hidden">
            <x-wildleafdining />
        </div>
    </div>
</div>
<!--
<div class="w-full flex gap-16 bg-jungle-brown py-10 mt-16">
    <h2 class="font-caveat leading-snug uppercase text-white text-4xl ml-64">Make A <br> Reservation</h2>
    <div>
        <span class="font-caveat text-white text-3xl">
            Contact local reservations to book <br>a restuarant at TigerDen
        </span>
    </div>
</div>
-->
@endsection