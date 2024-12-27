<?php

use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\DineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

//Page Load -> Guest
Route::get('/', [HomeController::class,'index'])->name('home');

//Offer Page Route
Route::get('/offers', [HomeController::class, 'offers'])->name('offers');

// Room Page Route
Route::get('/room', [RoomController::class, 'index'])->name('room');

//Room Details Page Route
Route::get('/room/{room_name}', [RoomController::class, 'roomdetails'])
    ->name('roomdetails')
    ->where('room_name', '.*'); 

//Room Options
Route::get('/rooms-with-prices', [BookController::class, 'getRoomNamesWithPrices']);

//Amenity Options
Route::get('/amenity-with-prices',[BookController::class, 'getAmenityNamesWithPrices']);

// Reservation Page Route
Route::get('/book', [BookController::class, 'index'])->name('book')->middleware('auth');

// Check Room Availability
Route::post('/check-room-availability', [RoomController::class, 'checkAvailability']);

// Reservation Routes (Require Authentication)
Route::middleware('auth')->group(function () {
    Route::post('/reserve', [BookController::class, 'reserve'])->name('reserve');
    Route::get('/reservation/success', [BookController::class, 'success'])->name('reservation.success');
    Route::get('/reservation/cancel', [BookController::class, 'cancel'])->name('reservation.cancel');
});

//Dine Page Route
Route::get('/dine', [DineController::class, 'index'])->name('dine');

//Amenities
Route::get('amenities', [AmenitiesController::class, 'index'])->name('amenities');

//Register Page Route
Route::get('/register', [UserController::class, 'register'])->name('register');
//Handle Register
Route::post('/register', [UserController::class, 'store'])->name('register.store');

//Login Page Route
Route::get('/login', [UserController::class, 'index'])->name('login');
//Handle Login
Route::post('/login', [UserController::class, 'login'])->name('login.post');

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {

    Route::get('/my-reservation', [BookController::class, 'myReservations'])->name('myreservation');
    Route::delete('/my-reservation/{id}/cancel', [BookController::class, 'cancelReservation'])->name('reservation.cancel');
    // Add more authenticated routes here if needed
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
?>