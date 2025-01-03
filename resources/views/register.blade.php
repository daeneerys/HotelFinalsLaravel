@extends('layouts.app')

@section('TigerDen', 'Register')

@section('content')
<div class="container mx-auto px-4 py-8">
</div>
<div class="w-4/5 mx-auto mt-8 mb-16">
    <h1 class="font-poppins text-4xl font-extralight">Your Profile</h1>
    <form method="POST" action="{{ route('register.store') }}" class="mt-6 w-4/6 font-inter">
        @csrf
        <div class="border border-gray-200 p-4">
            <h3 class="text-3xl font-poppins font-extralight">Profile Information</h3>
            <div class="grid grid-cols-2 gap-4 mt-6 mb-4 ">
                <div>
                    <label for="firstName" class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
                    <input type="text" name="first_name" placeholder="Enter First Name" id="firstName" class="block w-full p-3 text-gray-900 border border-gray-300  bg-gray-50 text-sm focus:ring-jungle-green focus:border-jungle-green">
                    @error('first_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="lastName" class="block mb-2 text-sm font-medium text-gray-900 ">Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter Last Name" id="lastName" class="block w-full p-3 text-gray-900 border border-gray-300 bg-gray-50 text-sm focus:ring-jungle-green focus:border-jungle-green">
                    @error('last_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-6 mb-4 ">
                <div>
                    <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 ">Phone Number</label>
                    <input type="tel" name="phone_number" id="phoneNumber" placeholder="Enter Phone Number" class="block w-full p-3 text-gray-900 border border-gray-300  bg-gray-50 text-sm focus:ring-jungle-green focus:border-jungle-green">
                    @error('phone_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-6 mb-4 ">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email" class="block w-full p-3 text-gray-900 border border-gray-300  bg-gray-50 text-sm focus:ring-jungle-green focus:border-jungle-green">
                    @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                </div>
            </div>
        </div>
        <div class="border border-gray-200 p-4 mt-4">
            <h3 class="text-3xl font-poppins font-extralight">Password</h3>
            <div class="grid grid-cols-2 gap-4 mt-6 mb-4 ">
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter Password" class="block w-full p-3 text-gray-900 border border-gray-300 bg-gray-50 text-sm focus:ring-jungle-green focus:border-jungle-green" />
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" id="confirm-password" class="block w-full p-3 text-gray-900 border border-gray-300 bg-gray-50 text-sm focus:ring-jungle-green focus:border-jungle-green" />
                    @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 mt-6 mb-4 border border-gray-200 p-4">
            <h3 class="text-3xl font-poppins font-extralight mb-4">Acknowledgment</h3>
            <div class="flex items-center space-x-2 mb-2">
                <input type="checkbox" name="privacy_terms" id="privacy-terms" class="h-4 w-4 text-jungle-green focus:ring-jungle-green" />
                <label for="privacy-terms" class="text-sm text-gray-900">
                    I agree with the <a href="/privacy-policy" class="text-jungle-green">Privacy Terms</a>
                </label>
                @error('privacy_terms')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="create_account" id="create-account" class="h-4 w-4 text-jungle-green focus:ring-jungle-green" />
                <label for="create-account" class="text-sm text-gray-900">
                    I would like to create an account
                </label>
                @error('create_account')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex justify-end space-x-4 mt-6">
            <button type="button" class="px-8 py-2 font-poppins font-light text-black bg-white border border-gray-500 ">Cancel</button>
            <button type="submit" class="px-8 py-2 font-poppins font-light text-white bg-jungle-green ">Submit</button>
        </div>
    </form>
</div>
@endsection