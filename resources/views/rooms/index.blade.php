{{-- filepath: c:\Coding\Laravel\booking\resources\views\Room\index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4" style="background-color: #fffbe9;">
                <div class="card-header text-center py-4 rounded-top-4 card-header-custom">
                    <h2 class="mb-0" style="color: #7c5e3c;">Room Listings</h2>
                </div>
                <div class="card-body p-4">
                    {{-- Tombol untuk membuka Modal Tambah Room --}}
                    <div class="mb-4 text-end">
                        <button type="button" class="btn btn-custom-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                            <i class="bi bi-plus-circle me-2"></i> Add New Room
                        </button>
                    </div>

                    {{-- Pesan Sukses (jika ada) --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb;">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Tabel Daftar Kamar --}}
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-custom rounded-3 overflow-hidden">
                            <thead class="text-nowrap">
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Price</th>
                                    <th scope="col" class="text-center">Capacity</th>
                                    <th scope="col" class="text-center">Deskription</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rooms as $room)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $room->id }}</th>
                                        <td>{{ $room->name_room }}</td>
                                        <td class="text-end">${{ number_format($room->price, 2) }}</td>
                                        <td class="text-center">{{ $room->capacity }}</td>
                                        <td>
                                            <span class="badge {{ $room->status === 'available' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($room->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm btn-custom-secondary">View</a>
                                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm btn-custom-secondary">Edit</a>
                                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-custom-danger" onclick="return confirm('Are you sure you want to delete this room?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center p-4">No rooms available. Please add a new room.</td>
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

{{-- Modal Tambah Room --}}
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4" style="background-color: #fffbe9;">
            <div class="modal-header card-header-custom rounded-top-4">
                <h5 class="modal-title" id="addRoomModalLabel" style="color: #7c5e3c;">Add New Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="name_room" class="form-label" style="color: #7c5e3c;">Room Name</label>
                        <input type="text" name="name_room" id="name_room" class="form-control form-control-custom" placeholder="e.g., Deluxe King" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label" style="color: #7c5e3c;">Price (USD)</label>
                        <input type="number" name="price" id="price" class="form-control form-control-custom" step="0.01" min="0" placeholder="e.g., 120.00" required>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label" style="color: #7c5e3c;">Capacity</label>
                        <input type="number" name="capacity" id="capacity" class="form-control form-control-custom" min="1" placeholder="e.g., 2" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label" style="color: #7c5e3c;">Description</label>
                        <textarea name="description" id="description" class="form-control form-control-custom" rows="3" placeholder="Enter room description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label" style="color: #7c5e3c;">Status</label>
                        <select name="status" id="status" class="form-select form-control-custom" required>
                            <option value="available">Available</option>
                            <option value="booked">Booked</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end p-3" style="border-top: 1px solid #e6d3b3;">
                    <button type="button" class="btn btn-custom-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom-primary">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
