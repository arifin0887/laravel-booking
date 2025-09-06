@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0" style="background-color: #fffbe9;">
                <div class="card-header text-center" style="background-color: #e6d3b3;">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: #7c5e3c;">Bookings</h2>
                </div>

                <div class="card-body">
                    {{--  Tombol untuk menambah booking --}}
                    <div class="mb-4 text-end">
                        <button type="button" class="btn btn-custom-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#addBookingModal">
                            <i class="bi bi-plus-circle me-2"></i> Add New Booking
                        </button>   
                    </div>

                    {{-- Pesan Sukses (jika ada) --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb;">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @foreach($bookings as $booking)
                        <div class="mb-4 border-bottom pb-3">
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
                                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-info me-2">View</a>
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Booking --}}
<div class="modal fade" id="addBookingModal" tabindex="-1" aria-labelledby="addBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #e6d3b3;">
                <h5 class="modal-title" id="addBookingModalLabel" style="color: #7c5e3c;">Add New Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="room_id" class="form-label" style="color: #7c5e3c;">Room</label>
                        <select name="room_id" id="room_id" class="form-select" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name_room }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label" style="color: #7c5e3c;">User</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="check_in" class="form-label" style="color: #7c5e3c;">Check-in Date</label>
                        <input type="date" name="check_in" id="check_in" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="check_out" class="form-label" style="color: #7c5e3c;">Check-out Date</label>
                        <input type="date" name="check_out" id="check_out" class="form-control" required>
                    </div>  
                    <div class="mb-3">
                        <label for="status" class="form-label" style="color: #7c5e3c;">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>    
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-custom-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-custom-primary">Save Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection