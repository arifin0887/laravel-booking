@extends('layouts.app')

@section('content')
<style>
    .card-custom {
        border-radius: 1rem; border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        overflow: hidden; background-color: var(--bg-white, #ffffff);
    }
    .card-header-custom {
        background-color: var(--brand-primary-dark, #5d4037); color: white;
        padding: 1.25rem 2rem;
    }
    .card-header-custom h2 {
        font-family: 'Playfair Display', serif; font-weight: 700;
        font-size: 1.5rem; margin-bottom: 0;
    }
    .card-body-custom {
        padding: 2.5rem;
    }
    .room-profile-header {
        text-align: center; border-bottom: 1px solid #f0e9e1;
        padding-bottom: 2rem; margin-bottom: 2rem;
    }
    .room-title {
        font-size: 2.75rem; font-weight: 700;
        font-family: 'Playfair Display', serif;
        color: var(--brand-text, #3e2723); margin-bottom: 0.5rem;
    }
    .room-price {
        font-size: 1.5rem; font-weight: 500;
        color: var(--text-muted, #757575);
    }
    .details-grid {
        display: grid; grid-template-columns: 1fr;
        gap: 2rem;
    }
    @media (min-width: 768px) { .details-grid { grid-template-columns: 1fr 1fr; } }
    .detail-item { display: flex; align-items: flex-start; gap: 1rem; }
    .detail-item .icon {
        flex-shrink: 0; width: 40px; height: 40px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background-color: #f0e9e1; color: var(--brand-primary-dark);
    }
    .detail-item-content .label { font-weight: 600; display: block; margin-bottom: 0.25rem; }
    .detail-item-content .value { color: var(--text-muted); }
    .description-box h3 { font-weight: 600; margin-bottom: 0.5rem; }
    .description-box p { line-height: 1.8; }
    
    /* Tombol Aksi */
    .action-buttons { margin-top: 2.5rem; display: flex; gap: 1rem; justify-content: flex-end; }
    .btn-custom {
        border-radius: 8px; font-weight: 600;
        padding: 0.6rem 1.25rem; border: none;
        transition: all 0.2s ease; text-decoration: none;
    }
    .btn-edit { background-color: var(--brand-accent, #c5a47e); color: var(--brand-text); }
    .btn-delete { background-color: #fbebeb; color: #ef4444; }
    .btn-back { background-color: #6c757d; color: white; }
    .btn-book-now {
        background-color: var(--brand-primary-dark); color: white;
        padding: 0.75rem 2rem; font-size: 1.1rem;
    }
    .btn-book-now:hover {
        background-color: #4e342e;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    /* Modal Styling */
    .modal-content-custom { background-color: #fdfaf5; border: none; border-radius: 1rem; box-shadow: 0 20px 50px rgba(0,0,0,0.2); }
    .modal-header-custom { background-color: #8a6d4c; padding: 1rem 1.5rem; border-bottom: none; color: white; }
    .modal-header-custom .modal-title { font-family: 'Playfair Display', serif; font-weight: 700; }
    .modal-body-custom { padding: 2rem; }
    .form-label-custom { font-weight: 600; color: var(--brand-text); margin-bottom: 0.5rem; }
    .form-control-custom, .form-select-custom { border-radius: 8px; padding: 0.75rem 1rem; border: 1px solid #d1c4b7; background-color: var(--bg-white); }
    .form-control-custom:focus, .form-select-custom:focus { border-color: var(--brand-primary-dark); box-shadow: 0 0 0 3px rgba(93, 64, 55, 0.2); }
    .modal-footer-custom { background-color: #f8f6f3; border-top: 1px solid #f0e9e1; padding: 1rem 2rem; display: flex; justify-content: flex-end; }
    .btn-cancel { background-color: #6c757d; color: white; }
    .btn-save { background-color: #fffbe9; color: #7c5e3c; border: 1px solid #e6d3b3; }
</style>

<div class="container">
    <div class="card-custom">
        <div class="card-header-custom">
            <h2>Room Details</h2>
        </div>
        <div class="card-body-custom">
            <div class="room-profile-header">
                <h1 class="room-title">{{ $room->name_room }}</h1>
                <p class="room-price">Rp {{ number_format($room->price, 0, ',', '.') }} / malam</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg></div>
                        <div class="detail-item-content"><span class="label">Capacity</span><span class="value">{{ $room->capacity }} Persons</span></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"/></svg></div>
                        <div class="detail-item-content"><span class="label">Status</span><span class="value">{{ ucfirst($room->status) }}</span></div>
                    </div>
                </div>
            </div>
            <div class="description-box mt-4">
                <h3>Description</h3>
                <p class="text-muted">{{ $room->description ?? 'No description available for this room.' }}</p>
            </div>
            <div class="action-buttons">
                <a href="{{ route('rooms.index') }}" class="btn btn-custom btn-back">Back to List</a>
                @if(auth()->user()->role === 'admin')
                    {{-- TOMBOL UNTUK ADMIN --}}
                    <button type="button" class="btn btn-custom btn-edit" data-bs-toggle="modal" data-bs-target="#editRoomModal">Edit Room</button>
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                        @csrf @method('DELETE')
                    </form>
                @else
                    {{-- TOMBOL UNTUK USER BIASA --}}
                    <button type="button" class="btn btn-custom btn-book-now" data-bs-toggle="modal" data-bs-target="#bookingModal">
                        Book Now
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ============================================= --}}
{{-- MODAL EDIT ROOM (HANYA UNTUK ADMIN) --}}
{{-- ============================================= --}}
@if(auth()->user()->role === 'admin')
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom"><h5 class="modal-title">Edit Room Details</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-body modal-body-custom">
                    <div class="mb-3"><label for="name_room_edit" class="form-label-custom">Room Name</label><input type="text" name="name_room" class="form-control form-control-custom" value="{{ $room->name_room }}" required></div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="price_edit" class="form-label-custom">Price (Rp)</label>
                            <input type="number" name="price" class="form-control form-control-custom" value="{{ $room->price }}" min="0" required>
                        </div>
                        <div class="col">
                            <label for="capacity_edit" class="form-label-custom">Capacity</label>
                            <input type="number" name="capacity" class="form-control form-control-custom" value="{{ $room->capacity }}" min="1" required>
                        </div>
                    </div>
                    <div class="mb-3"><label for="description_edit" class="form-label-custom">Description</label><textarea name="description" class="form-control form-control-custom" rows="3">{{ $room->description }}</textarea></div>
                    <div class="mb-3"><label for="status_edit" class="form-label-custom">Status</label><select name="status" class="form-select form-select-custom" required><option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option><option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Booked</option></select></div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-custom btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

{{-- ============================================= --}}
{{-- MODAL BOOKING (HANYA UNTUK USER BIASA) --}}
{{-- ============================================= --}}
@if(auth()->user()->role !== 'admin')
<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom"><h5 class="modal-title">Book: {{ $room->name_room }}</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf
                <div class="modal-body modal-body-custom">
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <div class="mb-3"><label for="start_time" class="form-label-custom">Start Time</label><input type="datetime-local" name="start_time" class="form-control form-control-custom" required></div>
                    <div class="mb-3"><label for="end_time" class="form-label-custom">End Time</label><input type="datetime-local" name="end_time" class="form-control form-control-custom" required></div>
                    <div class="mb-3"><label for="notes" class="form-label-custom">Notes (Optional)</label><textarea name="notes" class="form-control form-control-custom" rows="3" placeholder="Any special requests?"></textarea></div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-custom btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom btn-save">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection