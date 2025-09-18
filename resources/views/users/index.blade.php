@extends('layouts.app')

@section('content')
<style>
    /* Style dasar halaman (disamakan dengan halaman rooms) */
    .card-custom {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .card-header-custom {
        background-color: #e6d3b3; /* Warna header kartu dari gambar */
        padding: 1.25rem;
        border-bottom: none;
    }
    .card-header-custom h2 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: var(--brand-text);
        margin-bottom: 0;
        text-align: center;
    }
    .card-body-custom {
        background-color: #fffbe9; /* Warna body kartu dari gambar */
        padding: 1.5rem;
    }
    .table-custom {
        width: 100%;
        background-color: transparent;
        border-collapse: collapse;
    }
    .table-custom th, .table-custom td {
        padding: 0.9rem 1rem;
        vertical-align: middle;
        text-align: left;
        border: 1px solid #e6d3b3; /* Warna border tabel dari gambar */
    }
    .table-custom thead th {
        font-weight: 600;
        color: var(--brand-text);
        background-color: #ffffff; /* Header tabel putih seperti di gambar */
    }

    /* Tombol Kustom Sesuai Gambar */
    .btn-custom {
        border-radius: 6px;
        font-weight: 500;
        padding: 0.375rem 0.85rem;
        border: none;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-view-user {
        background-color: #3498db; /* Warna biru untuk View */
        color: white;
    }
    .btn-delete-user {
        background-color: #e74c3c; /* Warna merah untuk Delete */
        color: white;
    }
    
    /* Badge untuk Role */
    .role-badge {
        padding: 0.3em 0.8em;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.8rem;
    }
    .role-admin {
        background-color: #bdc3c7;
        color: #2c3e50;
    }
    .role-user {
        background-color: #ecf0f1;
        color: #34495e;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card-custom">
                <div class="card-header-custom">
                    <h2>Guest List</h2>
                </div>
                <div class="card-body-custom">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            @if($user->role === 'admin')
                                                <span class="role-badge role-admin">Admin</span>
                                            @else
                                                <span class="role-badge role-user">User</span>
                                            @endif
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-custom btn-view-user">View</a>
                                            
                                            {{-- Admin tidak bisa menghapus dirinya sendiri --}}
                                            @if(Auth::user()->id !== $user->id && $user->role !== 'admin')
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-custom btn-delete-user" onclick="return confirm('Anda yakin ingin menghapus pengguna ini?');">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center p-4 text-muted">Belum ada pengguna terdaftar.</td>
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
@endsection