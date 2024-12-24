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

<div class="container mt-16 mb-16 w-4/5 mx-auto">
    <div class="grid grid-cols-6 gap-8 mt-8 bg-jungle-light-brown px-12">
        <div class="col-span-3 flex items-center justify-center">
            <img alt="Dining Experience" class="w-full object-cover h-3/5 mx-auto" src="{{ asset('images/home_dine.jpg') }}" />
        </div>
        <div class="col-span-3 flex flex-col justify-center gap-5">
            <h1 class="text-3xl font-semibold font-inter">Dining Experience</h1>
            <p class="text-sm font-poppins text-gray-700">
                Savor exquisite flavors at TigerDen, where luxury meets nature in our diverse restaurants and cafes. 
                From treetop dining to riverside meals, each experience is a feast for the senses. <br>
                <a class = "text-jungle-green underline" href = "{{ route('dine') }}">Click here to see our restaurants.</a>
            </p>
        </div>
    </div>
    @foreach($amenities as $amenity)
    <div class="grid grid-cols-6 gap-8 mt-8 bg-jungle-light-brown px-12">
        <div class="col-span-3 flex items-center justify-center">
            <img alt="{{ $amenity->amenity_name }}" class="w-full object-cover h-3/5 mx-auto" src="{{ asset($amenity->image_path) }}" />
        </div>
        <div class="col-span-3 flex flex-col justify-center gap-5">
            <h1 class="text-3xl font-semibold font-inter">{{ $amenity->amenity_name }}</h1>
            <p class="text-sm font-poppins text-gray-700">
                {{ $amenity->description }}
            </p>
        </div>
    </div>
    @endforeach
</div>
@endsection