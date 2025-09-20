@extends('layouts.app')

@section('content')
<style>
    :root {
        --brand-brown: #7c5e3c;
        --brand-light: #fffbe9;
        --brand-accent: #e6d3b3;
    }

    .card-custom {
        background: var(--brand-light);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        border: none;
        transition: transform 0.2s ease;
    }
    .card-custom:hover {
        transform: translateY(-3px);
    }
    .card-header-custom {
        background: var(--brand-accent);
        color: var(--brand-brown);
        text-align: center;
        padding: 1.5rem;
    }
    .card-header-custom h2 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.75rem;
        margin: 0;
    }

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 10px;
        box-shadow: inset 0 0 4px rgba(0,0,0,0.05);
    }
    .detail-item i {
        font-size: 1.2rem;
        color: var(--brand-brown);
        margin-right: 0.75rem;
        flex-shrink: 0;
    }
    .detail-item strong {
        color: var(--brand-brown);
        min-width: 150px;
        flex-shrink: 0;
    }
    .detail-item span,
    .detail-item td {
        flex: 1;
    }

    .btn-custom {
        border-radius: 8px;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border: none;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .btn-back { background-color: #6c757d; color: white; }
    .btn-back:hover { background-color: #5a6268; }
    .btn-delete-room { background-color: #fbebeb; color: #ef4444; }
    .btn-delete-room:hover { background-color: #fcdcdc; }

    /* agar card lebih panjang melebar */
    .col-lg-10 {
        flex: 0 0 auto;
        width: 83.333333%; /* lebih lebar daripada col-md-8 */
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h2>Booking Details</h2>
                </div>
                <div class="card-body p-4">

                    <div class="detail-item">
                        <i class="bi bi-house-door-fill"></i>
                        <strong>Room Name:</strong>
                        <span>{{ $booking->room->name_room ?? '-' }}</span>
                    </div>

                    <div class="detail-item">
                        <i class="bi bi-person-circle"></i>
                        <strong>User Name:</strong>
                        <span>{{ $booking->user->name ?? '-' }}</span>
                    </div>

                    <div class="detail-item">
                        <i class="bi bi-calendar-check"></i>
                        <strong>Check-in:</strong>
                        <span>{{ $booking->start_time }}</span>
                    </div>

                    <div class="detail-item">
                        <i class="bi bi-calendar-x"></i>
                        <strong>Check-out:</strong>
                        <span>{{ $booking->end_time }}</span>
                    </div>

                    <div class="detail-item">
                        <i class="bi bi-info-circle"></i>
                        <strong>Status:</strong>
                        <span>
                            <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </span>
                    </div>

                    <div class="detail-item">
                        <i class="bi bi-sticky"></i>
                        <strong>Notes:</strong>
                        <span>{{ $booking->notes ?? '-' }}</span>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('bookings.index') }}" class="btn btn-back btn-custom btn-sm">
                            <i class="bi bi-arrow-left"></i> Back to Bookings
                        </a>
                        {{-- @if(auth()->user()->role === 'admin') --}}
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-custom btn-delete-room btn-sm" onclick="return confirm('Anda yakin ingin menghapus booking ini?');">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                        {{-- @endif --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
