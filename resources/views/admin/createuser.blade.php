@extends('layouts.app')

@section('TigerDen', 'Create Employee')

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-3xl font-semibold text-gray-700 mb-6">Create Employee</h2>

    <form action="{{ route('admin.employees.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="first_name" class="block">First Name</label>
            <input type="text" name="first_name" id="first_name" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="last_name" class="block">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block">Password</label>
            <input type="password" name="password" id="password" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white p-2 rounded">Create Employee</button>
    </form>
</div>
@endsection
