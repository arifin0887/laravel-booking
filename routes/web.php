<?php

use Illuminate\Support\Facades\Route;

// Tambahkan ->name('home'); di bagian akhir
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('rooms', App\Http\Controllers\RoomController::class);

Route::resource('bookings', App\Http\Controllers\BookingController::class);

Route::resource('users', App\Http\Controllers\UserController::class);