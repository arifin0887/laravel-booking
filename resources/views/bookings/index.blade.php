@extends('layouts.app')

@section('content')
<style>
    /* Style dasar halaman (disamakan dengan halaman rooms) */
    .card-custom {
        border-radius: 1rem; border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        overflow: hidden; background-color: var(--bg-white, #ffffff);
    }
    .card-header-custom {
        background-color: var(--brand-primary-dark, #5d4037); color: white;
        padding: 1.25rem 1.5rem; display: flex; justify-content: space-between;
        align-items: center;
    }
    .card-header-custom h2 {
        font-family: 'Playfair Display', serif; font-weight: 700;
        font-size: 1.5rem; margin-bottom: 0;
    }
    .card-body-custom {
        padding: 1.5rem; background-color: #fffaf0;
    }
    .table-custom {
        width: 100%; border-collapse: collapse; background-color: var(--bg-white, #ffffff);
        border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .table-custom th, .table-custom td {
        padding: 1rem 1.25rem; vertical-align: middle;
        text-align: left; border-bottom: 1px solid #f0e9e1;
    }
    .table-custom thead th {
        font-weight: 600; color: var(--text-muted, #757575);
        text-transform: uppercase; font-size: 0.75rem;
        letter-spacing: 0.5px; border-bottom-width: 2px;
    }
    .table-custom tbody tr:last-child td { border-bottom: none; }
    
    .filter-bar {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;
    }
    
    /* Tombol Kustom */
    .btn-custom {
        border-radius: 8px; font-weight: 600; padding: 0.5rem 1rem;
        border: none; transition: all 0.2s ease;
    }
    .btn-add-booking {
        background-color: var(--brand-accent, #c5a47e); color: var(--brand-text, #3e2723);
    }
    .btn-action-view { background-color: #f0f0f0; color: var(--brand-text, #3e2723); }
    .btn-action-edit { background-color: #e0e7ff; color: #4338ca; }
    .btn-action-delete { background-color: #fbebeb; color: #ef4444; }
    
    /* Badge Status */
    .badge-status { padding: 0.3em 0.8em; border-radius: 50rem; font-weight: 600; font-size: 0.75rem; }
    .badge-confirmed { background-color: #e0f8e9; color: #16a34a; }
    .badge-pending { background-color: #fffbeb; color: #f59e0b; }
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
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>#</th>
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
                                <td>{{ $booking->room->name_room ?? '-' }}</td>
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
                                    <a href="#" class="btn btn-sm btn-custom btn-action-view">View</a>
                                    @if(auth()->user()->role === 'admin')
                                        <a href="#" class="btn btn-sm btn-custom btn-action-edit">Edit</a>
                                    @endif
                                </td>
                            </tr>
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

{{-- Modal Add Booking (Hanya untuk Admin) --}}
@if(auth()->user()->role === 'admin')
<div class="modal fade" id="addBookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        {{-- ... Kode modal lengkap Anda dari request sebelumnya ... --}}
    </div>
</div>
@endif
@endsection