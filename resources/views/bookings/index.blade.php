@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #f8f6f3;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="background-color: #fffbe9;">
                <div class="card-header text-center" style="background-color: #e6d3b3;">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: #7c5e3c;">Booking Table</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label" style="color: #7c5e3c;">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required style="border-color: #e6d3b3;">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: #7c5e3c;">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required style="border-color: #e6d3b3;">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label" style="color: #7c5e3c;">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required style="border-color: #e6d3b3;">
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label" style="color: #7c5e3c;">Time</label>
                            <input type="time" class="form-control" id="time" name="time" required style="border-color: #e6d3b3;">
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label" style="color: #7c5e3c;">Number of Guests</label>
                            <input type="number" class="form-control" id="guests" name="guests" min="1" required style="border-color: #e6d3b3;">
                        </div>
                        <button type="submit" class="btn" style="background-color: #7c5e3c; color: #fffbe9; font-family: 'Playfair Display', serif;">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
@endpush