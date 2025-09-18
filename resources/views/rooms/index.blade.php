@extends('layouts.app')

@section('content')
<style>
    /* 
    =========================================================
    --- STYLE BARU UNTUK KESELURUHAN TAMPILAN "WOW" ---
    =========================================================
    */
    .card-custom {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        overflow: hidden;
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
        background-color: #fffaf0; /* Krem sangat muda */
        padding: 1.5rem;
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
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        background-color: #f8f9fa;
    }
    .table-custom tbody tr:last-child td {
        border-bottom: none;
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
    .btn-add-room {
        background-color: transparent;
        color: white;
        border: 1px solid rgba(255,255,255,0.7);
    }
    .btn-add-room:hover {
        background-color: rgba(255,255,255,0.1);
        border-color: white;
    }
    .btn-view-room, .btn-delete-room {
        font-size: 0.8rem;
        padding: 0.3rem 0.8rem;
    }
    .btn-view-room {
        background-color: #f0f0f0;
        color: var(--brand-text, #3e2723);
    }
    .btn-delete-room {
        background-color: #fbebeb;
        color: #ef4444;
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

    /* Tampilan Data Kosong */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background-color: var(--bg-white, #ffffff);
        border-radius: 0.75rem;
    }
    .empty-state p { color: var(--text-muted); }

    /* 
    =========================================================
    --- STYLE BARU UNTUK MODAL "ADD NEW ROOM" ---
    =========================================================
    */
    .modal-content-custom {
        background-color: #fdfaf5; /* Warna body modal */
        border: none;
        border-radius: 1rem;
        box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    }
    .modal-header-custom {
        background-color: #8a6d4c; /* Sesuai gambar */
        padding: 1rem 1.5rem;
        border-bottom: none;
        color: white;
    }
    .modal-header-custom .modal-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }
    .modal-body-custom {
        padding: 2rem;
    }
    .form-label-custom {
        font-weight: 600;
        color: var(--brand-text);
        margin-bottom: 0.5rem;
    }
    .form-control-custom, .form-select-custom {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #d1c4b7;
        background-color: var(--bg-white);
    }
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: var(--brand-primary-dark);
        box-shadow: 0 0 0 3px rgba(93, 64, 55, 0.2);
    }
    .modal-footer-custom {
        background-color: #f8f6f3;
        border-top: 1px solid #f0e9e1;
        padding: 1rem 2rem;
        display: flex;
        justify-content: flex-end;
    }
    .btn-cancel {
        background-color: #6c757d;
        color: white;
        border-radius: 8px;
        font-weight: 500;
    }
    .btn-save {
        background-color: #fffbe9;
        color: #7c5e3c;
        border: 1px solid #e6d3b3;
        border-radius: 8px;
        font-weight: 600;
    }
</style>

<div class="container">
    <div class="card card-custom">
        {{-- Tombol ini hanya akan muncul jika pengguna yang login adalah admin --}}
@if(auth()->user() && auth()->user()->role === 'admin')
    <div class="mb-4 text-end">
        <h2>Rooms List</h2>
        <button type="button" class="btn btn-custom btn-add-room" data-bs-toggle="modal" data-bs-target="#addRoomModal">
            + Add Room
        </button>
    </div>
@endif
        </div>
        <div class="card-body card-body-custom">
            @if(session('success'))
                <div class="alert alert-success m-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($rooms->isEmpty())
                <div class="empty-state">
                    <p>No rooms available yet. Please add a new room.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Name</th>
                                <th class="text-end">Price</th>
                                <th>Capacity</th>                                 
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td class="text-center fw-bold">{{ $room->id }}</td>
                                    <td>{{ $room->name_room }}</td>
                                    <td class="text-end fw-bold">Rp {{ number_format($room->price, 0, ',', '.') }}</td>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Modal Add Room (Didesain ulang total) --}}
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title">Add New Room</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf
                <div class="modal-body modal-body-custom">
                    <div class="mb-3">
                        <label for="name_room" class="form-label-custom">Room Name</label>
                        <input type="text" name="name_room" class="form-control form-control-custom" placeholder="e.g., Deluxe King" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label-custom">Price (Rp)</label>
                        <input type="number" name="price" class="form-control form-control-custom" min="0" placeholder="250000" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label-custom">Capacity</label>
                        <input type="number" name="capacity" class="form-control form-control-custom" min="1" placeholder="2" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label-custom">Description</label>
                        <textarea name="description" class="form-control form-control-custom" rows="3" placeholder="Enter room description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label-custom">Status</label>
                        <select name="status" class="form-select form-select-custom" required>
                            <option value="available">Available</option>
                            <option value="booked">Booked</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-custom btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom btn-save">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection