@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Welcome Card -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-10">
            <div class="card card-custom shadow-lg mb-4">
                <div class="card-body p-5 text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=e6d3b3&color=7c5e3c&size=128" 
                         alt="Avatar" class="avatar mb-3">
                    <h2 class="dashboard-title mb-2">Welcome, {{ Auth::user()->name ?? 'Admin' }}!</h2>
                    <p class="dashboard-text mb-0">This is your <strong>Admin Dashboard</strong>. Manage rooms and bookings with ease.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card menu-card text-center p-4">
                <h5 class="dashboard-title">Total Rooms</h5>
                <h2 class="dashboard-text">12</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card menu-card text-center p-4">
                <h5 class="dashboard-title">Approved Bookings</h5>
                <h2 class="dashboard-text">34</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card menu-card text-center p-4">
                <h5 class="dashboard-title">Pending Bookings</h5>
                <h2 class="dashboard-text">5</h2>
            </div>
        </div>
    </div>

    <!-- Daftar Ruangan -->
    <div class="card card-custom shadow-lg mb-5">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="dashboard-title mb-0">Room List</h5>
            <button class="menu-btn" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                + Add Room
            </button>
        </div>
        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Room Name</th>
                        <th>Price</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Meeting Room A</td>
                        <td>Rp 500.000</td>
                        <td>20 People</td>
                        <td><span class="badge bg-success">Available</span></td>
                        <td>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Daftar Booking -->
    <div class="card card-custom shadow-lg">
        <div class="card-header bg-light">
            <h5 class="dashboard-title mb-0">Recent Bookings</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between">
                    <span>User <b>Arifin</b> booked <b>Meeting Room A</b></span>
                    <span class="badge bg-warning">Pending</span>
                </li>
            </ul>
        </div>
    </div>

</div>

<!-- Modal Tambah Ruangan -->
<div class="modal fade" id="addRoomModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header" style="background:#7c5e3c; color:#fffbe9;">
        <h5 class="modal-title">Add Room</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Room Name</label>
            <input type="text" class="form-control" name="name_room" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" class="form-control" name="price" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" class="form-control" name="capacity" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="3" name="description"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="menu-btn">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
