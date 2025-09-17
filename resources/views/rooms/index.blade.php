@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f8f6f3;
        font-family: 'Playfair Display', serif;
    }
    .card-custom {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        background: #fffbe9;
        overflow: hidden;
    }
    .card-header-custom {
        background: linear-gradient(135deg, #7c5e3c, #a98467);
        color: #fffbe9;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: none;
    }
    .card-header-custom h2 {
        font-weight: bold;
        font-size: 1.5rem;
        margin-bottom: 0;
        font-family: 'Playfair Display', serif;
    }
    .table-responsive-custom {
        padding: 1.5rem;
    }
    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.75rem;
    }
    .table-custom thead th {
        font-weight: 600;
        color: #7c5e3c;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e6d3b3;
    }
    .table-custom tbody tr {
        background: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(124,94,60,0.08);
        transition: transform 0.2s ease;
    }
    .table-custom tbody tr:hover {
        transform: translateY(-3px);
    }
    .table-custom td {
        padding: 1rem;
        vertical-align: middle;
    }

    /* Tombol */
    .btn-custom {
        border-radius: 0.5rem;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-custom:hover {
        transform: translateY(-2px);
    }
    .btn-add-room {
        background: #fffbe9;
        color: #7c5e3c;
        border: 2px solid #e6d3b3;
    }
    .btn-add-room:hover {
        background: #7c5e3c;
        color: #fffbe9;
    }
    .btn-view-room {
        background: #fdfaf5;
        color: #7c5e3c;
    }
    .btn-view-room:hover {
        background: #e6d3b3;
    }
    .btn-delete-room {
        background: #fceaea;
        color: #d32f2f;
    }
    .btn-delete-room:hover {
        background: #f8d7da;
    }

    /* Badge */
    .badge-status {
        padding: 0.4em 1em;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-available {
        background: #e0f8e9;
        color: #2e7d32;
    }
    .badge-booked {
        background: #f3f4f6;
        color: #4b5563;
    }

    /* Modal */
    .modal-content {
        border-radius: 1rem;
        border: none;
    }
    .modal-header-custom {
        background: linear-gradient(135deg, #7c5e3c, #a98467);
        color: #fffbe9;
        border-bottom: none;
    }
    .modal-footer-custom {
        background: #f8f6f3;
        border-top: none;
    }
</style>

<div class="container py-4">
    <div class="card card-custom">
        <div class="card-header card-header-custom">
            <h2>Room Management</h2>
            @if(auth()->user()->isAdmin())
                <button type="button" class="btn btn-custom btn-add-room" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                    + Add Room
                </button>
            @endif
        </div>

        <div class="card-body card-body-custom">
            @if(session('success'))
                <div class="alert alert-success mx-4 my-3 shadow-sm rounded-3">
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
                                <td class="fw-semibold">{{ $room->name_room }}</td>
                                <td class="text-end">Rp {{ number_format($room->price, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $room->capacity }}</td>
                                <td class="text-center">
                                    @if($room->status === 'available')
                                        <span class="badge-status badge-available">Available</span>
                                    @else
                                        <span class="badge-status badge-booked">Booked</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-custom btn-view-room">View</a>
                                    @if(auth()->user()->isAdmin())
                                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-custom btn-delete-room" onclick="return confirm('Delete this room?');">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-4 text-muted">
                                    No rooms available yet. Please add a new room.
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
        <div class="modal-content shadow-lg">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title">Add New Room</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Room Name</label>
                        <input type="text" name="name_room" class="form-control" placeholder="e.g., Deluxe King" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Price (Rp)</label>
                        <input type="number" name="price" class="form-control" min="0" placeholder="250000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Capacity</label>
                        <input type="number" name="capacity" class="form-control" min="1" placeholder="2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter room description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="available">Available</option>
                            <option value="booked">Booked</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom btn-add-room">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
