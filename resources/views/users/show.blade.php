@extends('layouts.app')

@section('content')
<style>
    /* Style dasar halaman (disamakan dengan halaman rooms/bookings) */
    .card-custom {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        background-color: var(--bg-white, #ffffff);
    }
    .card-header-custom {
        background-color: var(--brand-primary-dark, #5d4037);
        color: white;
        padding: 1.25rem 1.5rem;
    }
    .card-header-custom h2 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 0;
        text-align: center;
    }
    .card-body-custom {
        padding: 2.5rem;
    }

    /* Style khusus untuk halaman detail */
    .profile-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: var(--brand-primary, #8a6d4c);
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 600;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .user-name {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .user-email {
        color: var(--text-muted, #757575);
        font-size: 1.1rem;
    }
    .details-list {
        list-style: none;
        padding: 0;
        margin-top: 2rem;
        border-top: 1px solid #f0e9e1;
        padding-top: 2rem;
    }
    .details-list li {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid #f0e9e1;
    }
     .details-list li:last-child {
        border-bottom: none;
     }
    .details-list .label {
        font-weight: 500;
        color: var(--text-muted, #757575);
    }
    .details-list .value {
        font-weight: 600;
    }

    .role-badge {
        background-color: #343a40;
        color: white;
        font-size: 0.9rem;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
    }

    .btn-back {
        background-color: #6c757d;
        color: white;
        font-weight: 500;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-back:hover {
        background-color: #5a6268;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-header-custom">
                    <h2>User Details</h2>
                </div>
                <div class="card-body card-body-custom">
                    
                    <div class="profile-header">
                        <div class="avatar">
                            {{-- Mengambil inisial dari nama pengguna --}}
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <h3 class="user-name">{{ $user->name }}</h3>
                        <p class="user-email">{{ $user->email }}</p>
                    </div>

                    <ul class="details-list">
                        <li>
                            <span class="label">Role</span>
                            <span class="value">
                                <span class="role-badge">{{ ucfirst($user->role) }}</span>
                            </span>
                        </li>
                        <li>
                            <span class="label">Account Created</span>
                            <span class="value">{{ $user->created_at->format('d M Y, H:i') }}</span>
                        </li>
                        {{-- Anda bisa menambahkan detail lain di sini, contoh: --}}
                        {{-- <li>
                            <span class="label">Total Bookings</span>
                            <span class="value">5</span>
                        </li> --}}
                    </ul>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('users.index') }}" class="btn btn-back">Back to Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection