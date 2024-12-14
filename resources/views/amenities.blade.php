@extends('layouts.app')

@section('TigerDen', 'Amenities')

@section('content')
<div class="container mx-auto mt-2 px-4 py-8">
</div>
<div class="relative w-full h-60 bg-cover bg-center" style="background-image: url('images/amenities_image1.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 flex items-center w-full h-full text-white">
        <div class="space-y-4 ml-32">
            <h2 class="text-3xl font-bold font-inter mb-8">Tiger Luxury Experience</h2>
            <h2 class="text-5xl w-192 font-poppins"> Facilities and Amenities </h2>
        </div>
    </div>
</div>
<!--Riverside Infinity Pool with Jungle Views && Treehouse Spa and Wellness Center -->
<div class="container mt-16 mb-16 w-4/5 mx-auto">
    <div class="grid grid-cols-6 gap-8 mt-8 bg-gray-100 px-12">
        <div class="col-span-3 flex items-center justify-center">
            <img alt="Amenities Trail" class="w-full object-cover h-3/5 mx-auto" src="{{ asset('images/amenities_trail.jpg') }}" />
        </div>
        <div class="col-span-3 flex flex-col justify-center gap-5">
            <h1 class="text-3xl font-semibold font-inter">Private Nature Trails and Jungle Safaris</h1>
            <p class="text-sm font-poppins text-gray-700">
                Wander through lush, verdant pathways alive with the sights and sounds of exotic wildlife,
                or embark on a safari led by expert guides who reveal the secrets of the jungle.
                Perfect for adventurers and nature enthusiasts,
                these experiences blend exploration and tranquility for unforgettable moments in our serene jungle paradise.
            </p>
        </div>
    </div>
    <div class="grid grid-cols-6 gap-8 mt-8 bg-gray-100 px-12">
        <div class="col-span-3 flex items-center justify-center">
            <img alt="Amenities Pool" class="w-full h-3/5 mx-auto" src="{{ asset('images/amenities_pool.webp') }}" />
        </div>
        <div class="col-span-3 flex flex-col justify-center gap-5 ">
            <h1 class="text-3xl font-semibold font-inter object-cover">Riverside Infinity Pool with Jungle Views</h1>
            <p class="text-sm font-poppins text-gray-700">
                Relax and rejuvenate at our stunning riverside infinity pool, where the serene waters merge seamlessly with breathtaking jungle vistas.
                Immerse yourself in the tranquil ambiance as you soak up panoramic views of lush greenery and the gentle flow of the river.
            </p>
        </div>
    </div>
    <div class="grid grid-cols-6 gap-8 mt-8 bg-gray-100 px-12">
        <div class="col-span-3 flex items-center justify-center">
            <img alt="Amenities Trail" class="w-full h-3/5 mx-auto object-cover" src="{{ asset('images/amenities_spa.webp') }}" />
        </div>
        <div class="col-span-3 flex flex-col justify-center gap-5">
            <h1 class="text-3xl font-semibold font-inter">Treehouse Spa and Wellness Center</h1>
            <p class="text-sm font-poppins text-gray-700">
                Elevate your senses at our exclusive Treehouse Spa and Wellness Center, perched amidst the lush canopy of the jungle.
                Experience rejuvenating treatments inspired by nature, surrounded by the soothing sounds of rustling leaves and birdsong.
            </p>
        </div>
    </div>
</div>
@endsection