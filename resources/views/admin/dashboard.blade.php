@extends('layouts.app')

@section('TigerDen', 'Admin Dashboard') <!-- Page Title -->

@section('content')
<div class="container mx-auto p-8">
    <!-- Dashboard Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-semibold text-gray-700">Welcome to the Admin Dashboard</h2>
        <a href="" class="text-red-600 hover:text-red-800">Logout</a>
    </div>

    <!-- Dashboard Stats or Info Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Users -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold">Total Employees</h3>
            <p class="text-3xl font-bold text-gray-700">{{ $totalEmployees }}</p>
        </div>

        <!-- Total Reservations -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold">Total Reservations</h3>
            <p class="text-3xl font-bold text-gray-700">{{ $totalReservations}}</p>
        </div>

        <!-- Admin Actions -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold">Admin Actions</h3>
            <ul>
                @if(auth()->user()->role !== 'employee')
                <li><a href="{{ route('admin.employees') }}" class="text-blue-600 hover:text-blue-800">Manage Employees</a></li>
                @endif
                <li><a href="{{ route('admin.managerooms') }}" class="text-blue-600 hover:text-blue-800">Manage Rooms</a></li>
                <li><a href="{{ route('admin.cancelrequest') }}" class="text-blue-600 hover:text-blue-800">Manage Cancel Request</a></li>
                <li><a href="{{ route('admin.viewReservations') }}" class="text-blue-600 hover:text-blue-800">View Reservations</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection