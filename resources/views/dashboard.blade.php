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
    {{-- Welcome Section --}}
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center justify-content-center bg-gradient p-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=7c5e3c&color=fff&size=150"
                             alt="Avatar" class="rounded-circle border border-4 border-light shadow-lg">
                    </div>
                    <div class="col-md-8 p-5 d-flex flex-column justify-content-center">
                        <h2 class="fw-bold mb-2 text-dark">Welcome, {{ Auth::user()->name ?? 'User' }} 👋</h2>
                        <p class="text-muted mb-0">
                            You are logged in as 
                            <span class="badge bg-dark px-3 py-2">{{ ucfirst(Auth::user()->role) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Dashboard Menu --}}
    <div class="row g-4">
        @if(Auth::user()->role === 'admin')
            {{-- ADMIN MENU --}}
            <div class="col-md-4">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body p-4">
                        <div class="icon-circle bg-primary text-white mb-3">
                            <i class="bi bi-house-door-fill fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Manage Rooms</h5>
                        <p class="text-muted">Add, edit, and delete available rooms</p>
                        <a href="{{ route('rooms.index') }}" class="btn btn-dark mt-3">Go</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body p-4">
                        <div class="icon-circle bg-warning text-dark mb-3">
                            <i class="bi bi-graph-up fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Booking</h5>
                        <p class="text-muted">Check booking history & statistics</p>
                        <a href="{{ route('bookings.index') }}" class="btn btn-dark mt-3">Go</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body p-4">
                        <div class="icon-circle bg-success text-white mb-3">
                            <i class="bi bi-people-fill fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Manage Users</h5>
                        <p class="text-muted">View and control registered users</p>
                        <a href="{{ route('users.index') }}" class="btn btn-dark mt-3">Go</a>
                    </div>
                </div>
            </div>
        @else
            {{-- USER MENU --}}
            <div class="col-md-6">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body p-4">
                        <div class="icon-circle bg-info text-white mb-3">
                            <i class="bi bi-calendar-plus-fill fs-2"></i>
                        </div>
                        <h5 class="fw-bold">Book a Room</h5>
                        <p class="text-muted">Choose a room and make your booking</p>
                        <a href="{{ route('rooms.index') }}" class="btn btn-dark mt-3">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card dashboard-card text-center h-100">
                    <div class="card-body p-4">
                        <div class="icon-circle bg-danger text-white mb-3">
                            <i class="bi bi-journal-text fs-2"></i>
                        </div>
                        <h5 class="fw-bold">My Bookings</h5>
                        <p class="text-muted">Check your booking status & history</p>
                        <a href="{{ route('bookings.index') }}" class="btn btn-dark mt-3">View</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Custom Style --}}
<style>
    .dashboard-card {
        border: none;
        border-radius: 1rem;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }
    .dashboard-card:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: 0 12px 28px rgba(0,0,0,0.15);
    }
    .icon-circle {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .bg-gradient {
        background: linear-gradient(135deg, #7c5e3c, #a98467);
        color: white;
    }
</style>

{{-- Bootstrap Icons --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection

</body>
</html>
