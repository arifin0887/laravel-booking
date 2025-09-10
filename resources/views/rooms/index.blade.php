@extends('layouts.app')

@section('content')
<style>
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
        padding: 0; /* Padding dihilangkan agar tabel menempel sempurna */
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
        border-bottom: 1px solid #f0e9e1; /* Garis horizontal yang lebih halus */
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

    /* Tombol Kustom Premium */
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
    .btn-add-room {
        background-color: var(--brand-accent, #c5a47e);
        color: var(--brand-text, #3e2723);
    }
    .btn-view-room {
        background-color: #f0f0f0;
        color: var(--brand-text, #3e2723);
    }
     .btn-view-room:hover {
        background-color: #e5e5e5;
    }
    .btn-delete-room {
        background-color: #fbebeb;
        color: #ef4444;
    }
    .btn-delete-room:hover {
        background-color: #fee2e2;
    }

    /* Badge Status Elegan */
    .badge-status {
        padding: 0.3em 0.8em;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-available {
        background-color: #e0f8e9;
        color: #16a34a;
    }
    .badge-booked {
        background-color: #f3f4f6;
        color: #4b5563;
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

<div class="container">
    <div class="card card-custom">
        <div class="card-header card-header-custom">
            <h2>Room Listings</h2>
             <button type="button" class="btn btn-custom btn-add-room" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg>
                Add Room
            </button>
        </div>
        <div class="card-body card-body-custom">
            @if(session('success'))
                <div class="alert alert-success mx-4 my-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive-custom">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Name</th>
                            <th class="text-end">Price</th>
                            <th class="text-center">Capacity</th>                                 
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                            <tr>
                                <td class="text-center fw-bold">{{ $room->id }}</td>
                                <td>{{ $room->name_room }}</td>
                                <td class="text-end">Rp {{ number_format($room->price, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $room->capacity }}</td>
                                <td class="text-center">
                                    @if($room->status === 'available')
                                        <span class="badge-status badge-available">Available</span>
                                    @else
                                        <span class="badge-status badge-booked">Booked</span>
                                    @endif
                                </td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-custom btn-view-room">View</a>
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-custom btn-delete-room" onclick="return confirm('Anda yakin ingin menghapus kamar ini?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-4 text-muted">Belum ada kamar tersedia. Silakan tambahkan kamar baru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal (dengan style yang disempurnakan) --}}
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem; border: none; overflow: hidden;">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title" id="addRoomModalLabel">Add New Room</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf
                <div class="modal-body modal-body-custom p-4">
                    <div class="mb-3">
                        <label for="name_room" class="form-label fw-bold" style="color: var(--brand-primary);">Room Name</label>
                        <input type="text" name="name_room" class="form-control" placeholder="e.g., Deluxe King" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label fw-bold" style="color: var(--brand-primary);">Price (Rp)</label>
                        <input type="number" name="price" class="form-control" min="0" placeholder="e.g., 250000" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label fw-bold" style="color: var(--brand-primary);">Capacity</label>
                        <input type="number" name="capacity" class="form-control" min="1" placeholder="e.g., 2" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold" style="color: var(--brand-primary);">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter room description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold" style="color: var(--brand-primary);">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="available">Available</option>
                            <option value="booked">Booked</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom d-flex justify-content-end p-3">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom btn-add-room">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection