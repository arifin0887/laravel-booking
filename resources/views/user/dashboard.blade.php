@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Welcome Card -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-10">
            <div class="card card-custom shadow-lg mb-4">
                <div class="card-body p-5 text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=e6d3b3&color=7c5e3c&size=128" 
                         alt="Avatar" class="avatar mb-3">
                    <h2 class="dashboard-title mb-2">Welcome, {{ Auth::user()->name ?? 'User' }}!</h2>
                    <p class="dashboard-text mb-0">Browse and book your favorite rooms below.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Ruangan -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card menu-card h-100">
                <img src="https://picsum.photos/400/250" class="card-img-top" alt="Room">
                <div class="card-body text-center">
                    <h5 class="dashboard-title">Meeting Room A</h5>
                    <p class="dashboard-text">Capacity: 20 <br> Price: Rp 500.000</p>
                    <button class="menu-btn w-100" data-bs-toggle="modal" data-bs-target="#bookingModal">
                        Book Now
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Booking -->
<div class="modal fade" id="bookingModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header" style="background:#7c5e3c; color:#fffbe9;">
        <h5 class="modal-title">Booking Form</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Room</label>
            <input type="text" class="form-control" value="Meeting Room A" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Start Time</label>
            <input type="datetime-local" class="form-control" name="start_time" required>
          </div>
          <div class="mb-3">
            <label class="form-label">End Time</label>
            <input type="datetime-local" class="form-control" name="end_time" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea class="form-control" rows="3" name="notes"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="menu-btn">Confirm Booking</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
