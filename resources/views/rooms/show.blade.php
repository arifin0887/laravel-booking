@extends('layouts.app')

@section('content')
<style>
    /* Style umum untuk halaman ini (tetap sama) */
    .card-custom {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        background-color: #ffffff;
    }
    .card-header-custom {
        background-color: var(--brand-card-header, #e6d3b3);
        padding: 1.25rem 2rem;
        border-bottom: 1px solid var(--border-color, #e0e0e0);
    }
    .card-header-custom h2 {
        font-weight: 600;
        color: var(--brand-text, #3e2723);
        margin-bottom: 0;
    }
    .card-body-custom {
        padding: 2rem;
    }

    /* Galeri Gambar */
    .gallery-container {
        border-radius: 12px;
        overflow: hidden;
    }
    .main-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 1rem;
    }
    .thumbnail-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    .thumbnail-grid img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.3s, transform 0.3s;
    }
    .thumbnail-grid img:hover, .thumbnail-grid img.active {
        opacity: 1;
        transform: scale(1.05);
    }
    
    /* Detail Info */
    .room-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--brand-text, #3e2723);
        margin-bottom: 1rem;
    }
    .details-list {
        list-style: none;
        padding: 0;
        margin-top: 1.5rem;
    }
    .details-list li {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }
    .details-list .icon {
        color: var(--brand-primary, #5d4037);
        margin-right: 1rem;
        width: 24px;
        flex-shrink: 0;
    }
    .details-list .label {
        font-weight: 600;
        color: var(--brand-text, #3e2723);
        margin-right: 0.5rem;
    }
    .price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--brand-primary, #5d4037);
    }
    .price span {
        font-size: 1rem;
        font-weight: 500;
        color: var(--brand-text-muted, #757575);
    }
    
    .description-box {
        margin-top: 2rem;
    }
    .description-box h3 {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    /* Tombol Aksi */
    .action-buttons {
        margin-top: 2rem;
        display: flex;
        gap: 1rem;
    }
    .btn-custom {
        border-radius: 8px;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border: none;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-edit {
        background-color: var(--brand-primary, #5d4037);
        color: white;
    }
    .btn-edit:hover {
        background-color: var(--brand-primary-hover, #4e342e);
        color: white;
    }
    .btn-back {
        background-color: transparent;
        color: var(--brand-text, #3e2723);
        border: 1px solid var(--border-color, #e0e0e0);
    }
    .btn-back:hover {
        background-color: #f8f9fa;
    }

    /* Style untuk Modal Edit */
    .modal-header-custom {
        background-color: var(--brand-card-header, #e6d3b3);
    }
    .modal-header-custom .modal-title {
        color: var(--brand-text, #3e2723);
        font-weight: 600;
    }
    .modal-body-custom {
        background-color: var(--brand-card-body, #fffbf2);
    }
    .modal-footer-custom {
        background-color: var(--brand-card-header, #e6d3b3);
    }
</style>

<div class="container">
    <div class="card-custom">
        <div class="card-header-custom">
            <h2>Room Details</h2>
        </div>
        <div class="card-body-custom">
            <div class="row">
                <!-- Kolom Kiri: Galeri Gambar -->
                <div class="col-lg-7">
                    <div class="gallery-container">
                        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=2070&auto=format&fit=crop" alt="Main Room Image" class="main-image">
                        <div class="thumbnail-grid">
                            <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=2070&auto=format&fit=crop" alt="Thumbnail 1" class="active">
                            <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16433d?q=80&w=2070&auto=format&fit=crop" alt="Thumbnail 2">
                            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=2158&auto=format&fit=crop" alt="Thumbnail 3">
                            <img src="https://images.unsplash.com/photo-1616046229478-9901c5536a45?q=80&w=2070&auto=format&fit=crop" alt="Thumbnail 4">
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Detail Informasi -->
                <div class="col-lg-5">
                    <h1 class="room-title">{{ $room->name_room }}</h1>
                    
                    <div class="price mb-4">
                        Rp {{ number_format($room->price, 0, ',', '.') }} <span>/ malam</span>
                    </div>

                    <ul class="details-list">
                        <li>
                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></span>
                            <div><span class="label">Capacity:</span> {{ $room->capacity }} persons</div>
                        </li>
                        <li>
                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg></span>
                            <div>
                                <span class="label">Status:</span> 
                                @if($room->status === 'available')
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-secondary">Booked</span>
                                @endif
                            </div>
                        </li>
                    </ul>

                    <div class="description-box">
                        <h3>Description</h3>
                        <p class="text-muted">{{ $room->description ?? 'No description available.' }}</p>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('rooms.index') }}" class="btn btn-custom btn-back">Back to List</a>
                        <!-- TOMBOL INI SEKARANG MEMBUKA MODAL -->
                        @if(auth()->user()->isAdmin())
                            <button type="button" class="btn btn-custom btn-edit" data-bs-toggle="modal" data-bs-target="#editRoomModal">
                                Edit Room
                            </button>
                        @endif

                        @if(auth()->user()->isUser())
                            <button type="button" class="btn btn-custom btn-edit" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                Booking
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ============================================= -->
<!-- MODAL UNTUK EDIT ROOM (BARU DITAMBAHKAN) -->
<!-- ============================================= -->
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem; border: none; overflow: hidden;">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title" id="editRoomModalLabel">Edit Room Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- Pastikan route 'rooms.update' sudah ada di file web.php Anda --}}
            <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body modal-body-custom p-4">
                    <div class="mb-3">
                        <label for="name_room_edit" class="form-label fw-bold" style="color: var(--brand-primary);">Room Name</label>
                        <input type="text" name="name_room" id="name_room_edit" class="form-control" value="{{ $room->name_room }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price_edit" class="form-label fw-bold" style="color: var(--brand-primary);">Price (Rp)</label>
                        <input type="number" name="price" id="price_edit" class="form-control" value="{{ $room->price }}" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity_edit" class="form-label fw-bold" style="color: var(--brand-primary);">Capacity</label>
                        <input type="number" name="capacity" id="capacity_edit" class="form-control" value="{{ $room->capacity }}" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="description_edit" class="form-label fw-bold" style="color: var(--brand-primary);">Description</label>
                        <textarea name="description" id="description_edit" class="form-control" rows="3">{{ $room->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status_edit" class="form-label fw-bold" style="color: var(--brand-primary);">Status</label>
                        <select name="status" id="status_edit" class="form-select" required>
                            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Booked</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom d-flex justify-content-end p-3">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom btn-edit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Booking -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem; border: none; overflow: hidden;">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title" id="bookingModalLabel">Book This Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      
      <form method="POST" action="{{ route('bookings.store') }}">
        @csrf

        <div class="modal-body p-4">
          <!-- Hidden Room ID -->
          <input type="hidden" name="room_id" value="{{ $room->id }}">
          <!-- Hidden User ID -->
          <input type="hidden" name="user_id" value="{{ auth()->id() }}">

          <div class="mb-3">
            <label class="form-label">Start Time</label>
            <input type="datetime-local" name="start_time" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">End Time</label>
            <input type="datetime-local" name="end_time" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="pending" selected>Pending</option>
              <option value="confirmed">Confirmed</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3" placeholder="Additional information (optional)"></textarea>
          </div>
        </div>

        <div class="modal-footer bg-light rounded-bottom-4">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-custom btn-edit">
            <i class="bi bi-save me-1"></i> Save Booking
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

@endsection