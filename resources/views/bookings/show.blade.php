@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="background-color: #fffbe9;">
                <div class="card-header text-center" style="background-color: #e6d3b3;">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: #7c5e3c;">Booking Details</h2>
                </div>
                <div class="card-body">
                    <p><strong style="color: #7c5e3c;">Room Name:</strong> {{ $booking->room->name_room ?? '-' }}</p>
                    <p><strong style="color: #7c5e3c;">User Name:</strong> {{ $booking->user->name ?? '-' }}</p>
                    <p><strong style="color: #7c5e3c;">Check-in Date:</strong> {{ $booking->check_in }}</p>
                    <p><strong style="color: #7c5e3c;">Check-out Date:</strong> {{ $booking->check_out }}</p>
                    <p><strong style="color: #7c5e3c;">Status:</strong> 
                        <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
