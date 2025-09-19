@extends('layouts.app')

@section('content')

{{-- =================================================================== --}}
{{-- LOGIKA UTAMA: Cek apakah pengguna adalah ADMIN atau bukan --}}
{{-- =================================================================== --}}

@if(auth()->user() && auth()->user()->role === 'admin')

    {{-- ************************************************* --}}
    {{-- BAGIAN INI HANYA AKAN TAMPIL UNTUK ADMIN --}}
    {{-- ************************************************* --}}
    <style>
        .card-custom { border-radius: 1rem; border: none; box-shadow: 0 15px 40px rgba(0,0,0,0.08); background-color: var(--bg-white, #ffffff); overflow: hidden; }
        .card-header-custom { background-color: var(--brand-primary-dark, #5d4037); color: white; padding: 1.25rem 1.5rem; display: flex; justify-content: space-between; align-items: center; }
        .card-header-custom h2 { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 1.5rem; margin-bottom: 0; }
        .card-body-custom { padding: 0; }
        .table-responsive-custom { padding: 0.5rem 1.5rem 1.5rem 1.5rem; }
        .table-custom { width: 100%; border-collapse: collapse; }
        .table-custom th, .table-custom td { padding: 1rem 1.25rem; vertical-align: middle; text-align: left; border-bottom: 1px solid #f0e9e1; }
        .table-custom thead th { font-weight: 600; color: var(--text-muted, #757575); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom-width: 2px; }
        .table-custom tbody tr:last-child td { border-bottom: none; }
        .table-custom tbody tr:hover { background-color: #fdfaf5; }
        .btn-custom { border-radius: 8px; font-weight: 600; padding: 0.5rem 1rem; border: none; transition: all 0.2s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; }
        .btn-custom:hover { transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .btn-add-room { background-color: var(--brand-accent, #c5a47e); color: var(--brand-text, #3e2723); }
        .btn-view-room { background-color: #f0f0f0; color: var(--brand-text, #3e2723); }
        .btn-delete-room { background-color: #fbebeb; color: #ef4444; }
        .badge-status { padding: 0.3em 0.8em; border-radius: 50rem; font-weight: 600; font-size: 0.75rem; }
        .badge-available { background-color: #e0f8e9; color: #16a34a; }
        .badge-booked { background-color: #f3f4f6; color: #4b5563; }
        .empty-state { text-align: center; padding: 4rem 2rem; }
        .empty-state h4 { font-weight: 600; }
        .empty-state p { color: var(--text-muted); margin-top: 0.5rem; }
        
        /* Style Modal */
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
                <h2>Room Management</h2>
                <button type="button" class="btn btn-custom btn-add-room" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg>
                    Add Room
                </button>
            </div>
            <div class="card-body card-body-custom">
                @if(session('success'))
                    <div class="alert alert-success mx-4 my-3">{{ session('success') }}</div>
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
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <h4>No Rooms Available Yet</h4>
                                            <p>Please click the "Add Room" button to start managing your properties.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Modal Add Room --}}
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
                        <div class="mb-3"><label for="name_room" class="form-label-custom">Room Name</label><input type="text" name="name_room" class="form-control form-control-custom" placeholder="e.g., Deluxe King" required></div>
                        <div class="mb-3"><label for="price" class="form-label-custom">Price (Rp)</label><input type="number" name="price" class="form-control form-control-custom" min="0" placeholder="250000" required></div>
                        <div class="mb-3"><label for="capacity" class="form-label-custom">Capacity</label><input type="number" name="capacity" class="form-control form-control-custom" min="1" placeholder="2" required></div>
                        <div class="mb-3"><label for="description" class="form-label-custom">Description</label><textarea name="description" class="form-control form-control-custom" rows="3" placeholder="Enter room description"></textarea></div>
                        <div class="mb-3"><label for="status" class="form-label-custom">Status</label><select name="status" class="form-select form-select-custom" required><option value="available">Available</option><option value="booked">Booked</option></select></div>
                    </div>
                    <div class="modal-footer modal-footer-custom">
                        <button type="button" class="btn btn-custom btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-custom btn-save">Save Room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@else

    {{-- ************************************************* --}}
    {{-- TAMPILAN BARU "WOW" UNTUK USER BIASA --}}
    {{-- ************************************************* --}}
    <style>
        .page-header { text-align: center; margin-bottom: 3rem; }
        .page-header h1 { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 2.75rem; }
        .page-header p { font-size: 1.1rem; color: var(--text-muted); max-width: 500px; margin: 0.5rem auto 0 auto; }
        
        .room-list-container {
            background-color: var(--bg-white);
            border-radius: 1rem;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            padding: 1rem;
        }
        .room-item {
            display: grid;
            grid-template-columns: 1fr;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            border-bottom: 1px solid #f0e9e1;
        }
        .room-item:last-child { border-bottom: none; }
        @media (min-width: 768px) { .room-item { grid-template-columns: 3fr 1fr 1fr; } }

        .room-info h3 { font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem; }
        .room-info .details { display: flex; align-items: center; gap: 1.5rem; color: var(--text-muted); font-size: 0.9rem; }
        .room-info .details span { display: flex; align-items: center; gap: 0.5rem; }
        
        .room-price { font-size: 1.5rem; font-weight: 700; color: var(--brand-primary-dark); text-align: left; }
        .room-price span { font-size: 0.9rem; font-weight: 400; color: var(--text-muted); }
        @media (min-width: 768px) { .room-price { text-align: right; } }

        .room-actions { text-align: center; }
        .btn-view-details {
            background-color: var(--brand-primary-dark); color: white;
            font-weight: 600; padding: 0.75rem 1.5rem; border-radius: 8px;
            text-decoration: none; transition: all 0.3s ease; width: 100%;
        }
        .btn-view-details:hover {
            background-color: #4e342e; box-shadow: 0 5px 20px rgba(93, 64, 55, 0.3);
            transform: translateY(-3px);
        }
        .badge-status { padding: 0.3em 0.8em; border-radius: 50rem; font-weight: 600; font-size: 0.75rem; }
        .badge-available { background-color: #e0f8e9; color: #16a34a; }
    </style>
    <div class="container">
        <div class="page-header">
            <h1>Our Room Collection</h1>
            <p>Discover our curated selection of rooms, each designed for your comfort and convenience.</p>
        </div>
        
        <div class="room-list-container">
            @forelse($rooms as $room)
                <div class="room-item">
                    <div class="room-info">
                        <h3>{{ $room->name_room }}</h3>
                        <div class="details">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg>
                                {{ $room->capacity }} Guests
                            </span>
                             @if($room->status === 'available')
                                <span class="badge-status badge-available">Available</span>
                            @endif
                        </div>
                    </div>
                    <div class="room-price">
                        Rp {{ number_format($room->price, 0, ',', '.') }} <span>/ night</span>
                    </div>
                    <div class="room-actions">
                         <a href="{{ route('rooms.show', $room->id) }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <p class="text-muted">Currently, no rooms are available. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
@endif

@endsection