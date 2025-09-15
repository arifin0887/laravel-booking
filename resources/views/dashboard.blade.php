{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Booking App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f6f3;
            font-family: 'Playfair Display', serif;
        }
        .card-custom {
            background: #fffbe9;
            border-radius: 1rem;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            border: none;
        }
        .dashboard-title {
            color: #7c5e3c;
            font-family: 'Playfair Display', serif;
            font-weight: bold;
        }
        .dashboard-text {
            color: #a98467;
            font-size: 1.1rem;
        }
        .avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e6d3b3;
            background: #e6d3b3;
        }
        .menu-card {
            background: #f8f6f3;
            border-radius: 0.75rem;
            box-shadow: 0 4px 16px rgba(124,94,60,0.08);
            border: none;
            transition: transform 0.2s;
        }
        .menu-card:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 8px 32px rgba(124,94,60,0.12);
        }
        .menu-btn {
            background-color: #7c5e3c;
            color: #fffbe9;
            font-family: 'Playfair Display', serif;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border: none;
            transition: background 0.2s;
        }
        .menu-btn:hover {
            background-color: #a98467;
            color: #fffbe9;
        }
    </style>
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom shadow-lg mb-4">
                <div class="card-body p-5 text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=e6d3b3&color=7c5e3c&size=128" alt="Avatar" class="avatar mb-3">
                    <h2 class="dashboard-title mb-2">Welcome, {{ Auth::user()->name ?? 'User' }}!</h2>
                    <p class="dashboard-text mb-0">You are successfully logged in to <strong>Booking App</strong>.</p>
                </div>
            </div>
            {{-- <div class="row g-4">
                <div class="col-md-6">
                    <div class="card menu-card h-100 text-center p-4">
                        <h5 class="mb-3" style="color:#7c5e3c;">Room List</h5>
                        <p class="mb-4" style="color:#a98467;">View, add, or manage all available rooms in the system.</p>
                        <a href="{{ route('rooms.index') }}" class="menu-btn w-100">Go to Rooms</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card menu-card h-100 text-center p-4">
                        <h5 class="mb-3" style="color:#7c5e3c;">Booking List</h5>
                        <p class="mb-4" style="color:#a98467;">Check, create, or manage all bookings made by users.</p>
                        <a href="{{ route('bookings.index') }}" class="menu-btn w-100">Go to Bookings</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
</body>
</html>
