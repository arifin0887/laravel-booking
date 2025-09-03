@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="background-color: #fffbe9;">
                <div class="card-header text-center" style="background-color: #e6d3b3;">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: #7c5e3c;">Room Details</h2>
                </div>
                <div class="card-body">
                    <h3 class="card-title mb-3" style="color: #7c5e3c;">{{ $room->name_room }}</h3>
                    <p class="card-text"><strong style="color: #7c5e3c;">Price:</strong> ${{ number_format($room->price, 2) }}</p>
                    <p class="card-text"><strong style="color: #7c5e3c;">Capacity:</strong> {{ $room->capacity }} persons</p>
                    <p class="card-text"><strong style="color: #7c5e3c;">Status:</strong> 
                        <span class="badge {{ $room->status === 'available' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($room->status) }}
                        </span> 
                    </p>
                    <p class="card-text"><strong style="color: #7c5e3c;">Description:</strong></p>
                    <p class="card-text" style="color: #7c5e3c;">{{ $room->description }}</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('rooms.index') }}" class="btn btn-custom-secondary me-2">Back to List</a>
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-custom-primary">Edit Room</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection