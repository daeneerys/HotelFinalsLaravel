@extends('layouts.app')

@section('TigerDen', 'Login')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="flex max-w-2xl w-full bg-white shadow-lg">
        <div class="w-1/2 bg-jungle-green flex flex-col justify-center shadow-lg"
            style="background-image: url('images/Tigerden_Logo.png'); 
           background-size: cover; 
           background-position: center; 
           background-repeat: no-repeat;
           ">
        </div>
        <div class="w-1/2 p-10">
            <div class="font-poppins">
                <h2 class="text-3xl font-bold font-poppins text-jungle-green">Login</h2>
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mt-4">
                        <label class="block mb-1" for="email">Email</label>
                        <input class="w-full h-10 px-2 border border-gray-300 rounded focus:outline-none focus:border-jungle-green"
                            type="text"
                            id="email"
                            name="email"
                            placeholder="Email"
                            required />
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block mb-1" for="password">Password</label>
                        <input class="w-full h-10 px-2 border border-gray-300 rounded focus:outline-none focus:border-jungle-green"
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Password"
                            required />
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <input class="w-full h-10 bg-jungle-green text-white rounded cursor-pointer transition duration-300 hover:bg-jungle-brown" type="submit" value="Sign In" />
                    </div>
                    <div class="mt-4 flex flex-col space-y-2">
                        <a class="text-jungle-green text-sm hover:text-jungle-brown" href="{{ route ('register')}}">Create an account.</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection