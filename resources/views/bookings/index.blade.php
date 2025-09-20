@extends('layouts.app')

@section('content')
<style>
    /* Style dasar halaman (disamakan dengan halaman rooms) */
    .card-custom {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        background-color: var(--bg-white, #ffffff);
    }
    .card-header-custom {
        background-color: var(--brand-primary-dark, #5d4037);
        color: white;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-header-custom h2 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 0;
    }
    .card-body-custom {
        padding: 1.5rem;
        background-color: #fffaf0;
    }
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        background-color: var(--bg-white, #ffffff);
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .table-custom th, .table-custom td {
        padding: 1rem 1.25rem;
        vertical-align: middle;
        text-align: left;
        border-bottom: 1px solid #f0e9e1;
    }
    .table-custom thead th {
        font-weight: 600;
        color: var(--text-muted, #757575);
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        background-color: #f8f9fa;
    }
    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Tombol Kustom */
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
    .btn-action-view { background-color: #f0f0f0; color: var(--brand-text, #3e2723); }
    .btn-action-edit { background-color: #e0e7ff; color: #4338ca; }
    
    /* Badge Status */
    .badge-status { padding: 0.3em 0.8em; border-radius: 50rem; font-weight: 600; font-size: 0.75rem; }
    .badge-confirmed { background-color: #e0f8e9; color: #16a34a; }
    .badge-pending { background-color: #fffbeb; color: #f59e0b; }
    
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
    <div class="card card-custom">
        <div class="card-header card-header-custom">
            @if(auth()->user()->role === 'admin')
                <h2>All Bookings</h2>
            @else
                <h2>My Booking History</h2>
            @endif
            
            @if(auth()->user()->role === 'admin')
                <button type="button" class="btn btn-custom btn-add-booking" data-bs-toggle="modal" data-bs-target="#addBookingModal">
                    + Add Booking
                </button>
            @endif
        </div>
        <div class="card-body card-body-custom">
            @if(session('success'))
                <div class="alert alert-success m-4">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room</th>
                            @if(auth()->user()->role === 'admin')
                                <th>User</th>
                            @endif
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                <td>{{ $booking->room->name_room ?? '-' }}</td> {{-- PERBAIKAN DI SINI --}}
                                @if(auth()->user()->role === 'admin')
                                    <td>{{ $booking->user->name ?? '-' }}</td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y, H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y, H:i') }}</td>
                                <td class="text-center">
                                    <span class="badge-status {{ $booking->status === 'confirmed' ? 'badge-confirmed' : 'badge-pending' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-custom btn-action-view">View</a>
                                    @if(auth()->user()->role === 'admin')
                                    <button class="btn btn-sm btn-custom btn-action-edit" data-bs-toggle="modal" data-bs-target="#editBookingModal{{ $booking->id }}">
                                        Edit
                                    </button>
                                    @endif
                                </td>
                            </tr>

                            @if(auth()->user()->role === 'admin')
                            <div class="modal fade" id="editBookingModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content" style="background-color: #fffbe9;">
                                <div class="modal-header" style="background-color: #e6d3b3;">
                                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #7c5e3c;">
                                    Edit Booking: {{ $booking->room->name_room }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="room_id{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">Room</label>
                                        <select name="room_id" id="room_id{{ $booking->id }}" class="form-select" required>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                                            {{ $room->name_room }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="user_id{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">User</label>
                                        <select name="user_id" id="user_id{{ $booking->id }}" class="form-select" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="start_time{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">Start Time</label>
                                        <input type="datetime-local" name="start_time" id="start_time{{ $booking->id }}" 
                                                class="form-control"
                                                value="{{ \Carbon\Carbon::parse($booking->start_time)->format('Y-m-d\TH:i') }}" required>
                                        </div>

                                        <div class="mb-3">
                                        <label for="end_time{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">End Time</label>
                                        <input type="datetime-local" name="end_time" id="end_time{{ $booking->id }}" 
                                                class="form-control"
                                                value="{{ \Carbon\Carbon::parse($booking->end_time)->format('Y-m-d\TH:i') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="status{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">Status</label>
                                        <select name="status" id="status{{ $booking->id }}" class="form-select" required>
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        </select>
                                    </div>
                                    
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-custom btn-add-booking">Update Booking</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            @endif
                            
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? '7' : '6' }}" class="text-center p-4 text-muted">
                                    @if(auth()->user()->role === 'admin')
                                        No bookings found in the system.
                                    @else
                                        You haven't made any bookings yet.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Add Booking (Hanya akan dirender jika pengguna adalah Admin) --}}
@if(auth()->user()->role === 'admin')
<div class="modal fade" id="addBookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title">Add New Booking</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <div class="modal-body modal-body-custom">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="room_id" class="form-label-custom">Room</label>
                            <select name="room_id" class="form-select form-select-custom" required>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name_room }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label-custom">User</label>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <select name="user_id" class="form-select form-select-custom" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_time" class="form-label-custom">Start Time</label>
                            <input type="datetime-local" name="start_time" class="form-control form-control-custom" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_time" class="form-label-custom">End Time</label>
                            <input type="datetime-local" name="end_time" class="form-control form-control-custom" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label-custom">Status</label>
                        <select name="status" class="form-select form-select-custom" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label-custom">Notes</label>
                        <textarea name="notes" class="form-control form-control-custom" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-custom btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom btn-save">Save Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if(auth()->user()->role === 'admin')
<div class="modal fade" id="editBookingModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="background-color: #fffbe9;">
      <div class="modal-header" style="background-color: #e6d3b3;">
        <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #7c5e3c;">
          Edit Booking: {{ $booking->room->name_room }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <div class="mb-3">
            <label for="room_id{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">Room</label>
            <select name="room_id" id="room_id{{ $booking->id }}" class="form-select" required>
              @foreach($rooms as $room)
                <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                  {{ $room->name_room }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="user_id{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">User</label>
            <select name="user_id" id="user_id{{ $booking->id }}" class="form-select" required>
              @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                  {{ $user->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="start_time{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">Start Time</label>
            <input type="datetime-local" name="start_time" id="start_time{{ $booking->id }}" 
                    class="form-control"
                    value="{{ \Carbon\Carbon::parse($booking->start_time)->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="mb-3">
            <label for="end_time{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">End Time</label>
            <input type="datetime-local" name="end_time" id="end_time{{ $booking->id }}" 
                    class="form-control"
                    value="{{ \Carbon\Carbon::parse($booking->end_time)->format('Y-m-d\TH:i') }}" required>
          </div>

          <div class="mb-3">
            <label for="status{{ $booking->id }}" class="form-label" style="color: #7c5e3c;">Status</label>
            <select name="status" id="status{{ $booking->id }}" class="form-select" required>
              <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            </select>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-custom btn-add-booking">Update Booking</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
@endsection