<?php

use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\DineController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Page Load -> Guest
Route::get('/', [HomeController::class,'index'])->name('home');

//Offer Page Route
Route::get('/offers', [HomeController::class, 'offers'])->name('offers');

// Room Page Route
Route::get('/room', [RoomController::class, 'index'])->name('room');

//Dine Page Route
Route::get('/dine', [DineController::class, 'index'])->name('dine');

//Amenities
Route::get('amenities', [AmenitiesController::class, 'index'])->name('amenities');

//Login Page Route
Route::get('/login', [UserController::class, 'index'])->name('login');

//Register Page Route
Route::get('/register', [UserController::class, 'register'])->name('register');
?>