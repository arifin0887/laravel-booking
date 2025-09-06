@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class ="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="background-color: #fffbe9;">
                <div class="card-header text-center" style="background-color: #e6d3b3;">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: #7c5e3c;">Edit Booking</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="room_id" class="form-label" style="color: #7c5e3c;">Room</label>
                            <select name="room_id" id="room_id" class="form-select" required>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                                        {{ $room->name_room }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label" style="color: #7c5e3c;">User</label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="check_in" class="form-label" style="color: #7c5e3c;">Check-in Date</label>
                            <input type="date" name="check_in" id="check_in" class="form-control" value="{{ $booking->check_in }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="check_out" class="form-label" style="color: #7c5e3c;">Check-out Date</label>
                            <input type="date" name="check_out" id="check_out" class="form-control" value="{{ $booking->check_out }}" required>
                        </div>  
                        <div class="mb-3">
                            <label for="status" class="form-label" style="color: #7c5e3c;">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
