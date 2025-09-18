@extends('layouts.app') {{-- Baris ini memberitahu file ini untuk menggunakan kerangka app.blade.php --}}

@section('content') {{-- Baris ini menandai awal dari konten yang akan dimasukkan ke kerangka --}}
<style>
    /* 
    =========================================================
    --- STYLE BARU UNTUK KONTEN DASHBOARD "WOW" ---
    =========================================================
    */
    
    /* Animasi */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dashboard-card {
        background-color: var(--bg-white, #ffffff);
        border-radius: 1.5rem;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        animation: fadeInUp 0.7s ease-out;
    }

    /* Kartu Sambutan */
    .welcome-card-body {
        display: flex;
        flex-direction: column; /* Ubah ke kolom untuk mobile */
        align-items: center;
        text-align: center;
        padding: 2rem;
    }
    @media (min-width: 768px) {
        .welcome-card-body {
            flex-direction: row; /* Kembali ke baris untuk desktop */
            text-align: left;
        }
    }
    .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: var(--brand-primary, #5d4037);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem; /* Margin bawah untuk mobile */
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
     @media (min-width: 768px) {
        .avatar {
            margin-right: 2rem;
            margin-bottom: 0;
        }
    }
    .welcome-text h2 {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--brand-text, #3e2723);
        margin-bottom: 0.25rem;
    }
    .welcome-text p {
        color: var(--text-muted, #757575);
        margin-bottom: 0.5rem;
    }
    .role-badge {
        background-color: #343a40;
        color: white;
        font-size: 0.8rem;
        font-weight: 500;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
    }

    /* Kartu Aksi */
    .action-card {
        text-align: center;
        padding: 2.5rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 45px rgba(0,0,0,0.12);
    }
    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem auto;
    }
    .icon-blue { background-color: #e0f2fe; }
    .icon-red { background-color: #ffe4e6; }
    .action-card h3 {
        font-weight: 600;
        color: var(--brand-text, #3e2723);
        margin-bottom: 0.5rem;
    }
    .action-card p {
        color: var(--text-muted, #757575);
        margin-bottom: 2rem;
        flex-grow: 1; /* Membuat deskripsi mengisi ruang */
    }
    .btn-action {
        background-color: #212529;
        color: white;
        font-weight: 500;
        padding: 0.6rem 2rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-action:hover {
        background-color: #000;
        transform: translateY(-2px);
    }
</style>

<div class="container">

    <!-- Kartu Sambutan Baru -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-10 col-md-12">
            <div class="dashboard-card" style="animation-delay: 0.2s;">
                <div class="welcome-card-body">
                    <div class="avatar">
                        {{-- Mengambil inisial dari nama pengguna --}}
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="welcome-text">
                        <h2>Welcome, {{ Auth::user()->name ?? 'User' }} 👋</h2>
                        <p>
                            You are logged in as <span class="role-badge">{{ ucfirst(Auth::user()->role) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Aksi Dinamis Berdasarkan Peran -->
    <div class="row justify-content-center g-4">
        @if(Auth::user()->role === 'admin')
            {{-- Tampilan untuk ADMIN --}}
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-card action-card" style="animation-delay: 0.4s;">
                    <div>
                        <div class="action-icon icon-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                        <h3>Manage Rooms</h3>
                        <p>Add, edit, or view room details</p>
                    </div>
                    <a href="{{ route('rooms.index') }}" class="btn-action">Go</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-card action-card" style="animation-delay: 0.6s;">
                    <div>
                        <div class="action-icon icon-orange">
                           <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 2v6h6V2H2.5zM15.5 2v6h6V2h-6zM2.5 16v6h6v-6H2.5zM15.5 16v6h6v-6h-6z"/></svg>
                        </div>
                        <h3>Manage Bookings</h3>
                        <p>View and confirm all user bookings</p>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="btn-action">Go</a>
                </div>
            </div>
             <div class="col-lg-3 col-md-6">
                <div class="dashboard-card action-card" style="animation-delay: 0.8s;">
                    <div>
                        <div class="action-icon icon-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <h3>Manage Users</h3>
                        <p>View and manage all registered users</p>
                    </div>
                    <a href="{{ route('users.index') }}" class="btn-action">Go</a>
                </div>
            </div>
        @else
            {{-- Tampilan untuk USER BIASA --}}
            <div class="col-lg-5 col-md-6">
                <div class="dashboard-card action-card" style="animation-delay: 0.4s;">
                    <div>
                        <div class="action-icon icon-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" x2="16" y1="2" y2="6"></line><line x1="8" x2="8" y1="2" y2="6"></line><line x1="3" x2="21" y1="10" y2="10"></line><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                        </div>
                        <h3>Book a Room</h3>
                        <p>Choose an available room and make your booking</p>
                    </div>
                    <a href="{{ route('rooms.index') }}" class="btn-action">Book Now</a>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="dashboard-card action-card" style="animation-delay: 0.6s;">
                    <div>
                        <div class="action-icon icon-red">
                           <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                        </div>
                        <h3>My Bookings</h3>
                        <p>Check your booking status & history</p>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="btn-action">View</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection {{-- Baris ini menandai akhir dari konten --}}