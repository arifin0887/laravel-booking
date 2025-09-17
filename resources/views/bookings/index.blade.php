@extends('layouts.app')

@section('content')
<style>
    /* Booking Page Custom Style */
    .card-custom {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        background-color: #ffffff;
        overflow: hidden;
    }
    .card-header-custom {
        background-color: var(--brand-primary, #5d4037);
        color: white;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-header-custom h2 {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 0;
    }
    .card-body-custom {
        padding: 0;
    }
    .table-responsive-custom {
        padding: 0.5rem 1.5rem 1.5rem 1.5rem;
    }
    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }
    .table-custom th, .table-custom td {
        padding: 1rem;
        vertical-align: middle;
        text-align: left;
        border-bottom: 1px solid #f0e9e1;
    }
    .table-custom thead th {
        font-weight: 600;
        color: var(--brand-text-muted, #757575);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0d7cb;
    }
    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }
    .table-custom tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-custom tbody tr:hover {
        background-color: #fdfaf5;
    }

    /* Custom Buttons */
    .btn-custom {
        border-radius: 8px;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border: none;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .btn-add-booking {
        background-color: var(--brand-accent, #c5a47e);
        color: var(--brand-text, #3e2723);
    }
    .btn-view-booking {
        background-color: #f0f0f0;
        color: var(--brand-text, #3e2723);
    }
    .btn-view-booking:hover {
        background-color: #e5e5e5;
    }
    .btn-delete-booking {
        background-color: #fbebeb;
        color: #ef4444;
    }
    .btn-delete-booking:hover {
        background-color: #fee2e2;
    }

    /* Badge Status */
    .badge-status {
        padding: 0.3em 0.8em;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-pending {
        background-color: #f3f4f6;
        color: #4b5563;
    }
    .badge-confirmed {
        background-color: #e0f8e9;
        color: #16a34a;
    }

    /* Modal Styling */
    .modal-header-custom {
        background-color: var(--brand-primary, #5d4037);
        color: white;
    }
    .modal-header-custom .modal-title {
        font-weight: 600;
    }
    .modal-body-custom {
        background-color: #fdfdfd;
    }
    .modal-footer-custom {
        background-color: #f8f9fa;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-custom shadow-sm border-0">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <span>Bookings</span>

                    {{-- Hanya admin yang bisa tambah booking --}}
                    @if(auth()->user()->isAdmin())
                        <button type="button" class="btn-custom btn-add-booking" data-bs-toggle="modal" data-bs-target="#addBookingModal">
                            <i class="bi bi-plus-circle me-2"></i> Add Booking
                        </button>
                    @endif
                </div>

                <div class="card-body card-body-custom">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb;">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive table-responsive-custom">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Room</th>
                                    <th>User</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->room->name_room ?? '-' }}</td>
                                        <td>{{ $booking->user->name ?? '-' }}</td>
                                        <td>{{ $booking->start_time }}</td>
                                        <td>{{ $booking->end_time }}</td>
                                        <td>
                                            <span class="badge badge-custom {{ $booking->status === 'confirmed' ? 'badge-confirmed' : 'badge-pending' }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $booking->notes ?? '-' }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn-custom btn-view-booking me-2">View</a>

                                            {{-- Hanya admin yang bisa edit & delete --}}
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn-custom btn-add-booking">Edit</a>

                                                <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-custom btn-delete-booking" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No bookings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
                <h5 class="modal-title" id="addBookingModalLabel" style="color: #7c5e3c; font-family: 'Playfair Display', serif;">Add New Booking</h5>
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
                        <label for="start_time" class="form-label" style="color: #7c5e3c;">Start Time</label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label" style="color: #7c5e3c;">End Time</label>
                        <input type="datetime-local" name="end_time" id="end_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label" style="color: #7c5e3c;">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label" style="color: #7c5e3c;">Notes</label>
                        <textarea name="notes" id="notes" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-custom btn-view-booking me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-custom btn-add-booking">Save Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection