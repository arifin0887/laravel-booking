@extends('layouts.app')

@section('content')
<style>
/* Card */
.card-custom {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    overflow: hidden;
}
.card-header-custom {
    background-color: #e6d3b3;
    padding: 1.25rem;
    border-bottom: none;
}
.card-header-custom h2 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    color: #3e2723; /* brand-text */
    margin-bottom: 0;
    text-align: center;
}
.card-body-custom {
    background-color: #fffbe9;
    padding: 1.5rem;
}

/* Tabel */
.table-custom {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 1rem;
    overflow: hidden;
    background-color: #fffbe9;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.table-custom th, .table-custom td {
    padding: 0.75rem 1rem;
    text-align: left;
    vertical-align: middle;
    border-bottom: 1px solid #e6d3b3;
    color: #3e2723;
}
.table-custom thead th {
    background-color: #fdfaf5;
    color: #5d4037;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}
.table-custom tbody tr:last-child td {
    border-bottom: none;
}
.table-custom tbody tr:hover {
    background-color: #fff3e0;
}
.table-custom td.text-center { text-align: center; }
.table-custom td.text-nowrap { white-space: nowrap; }

/* Tombol */
.btn-custom {
    border-radius: 8px;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border: none;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}
.btn-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Tombol Action */
.btn-view-user {
    background-color: #f0f0f0;
    color: #3e2723;
}
.btn-view-user:hover {
    background-color: #e6e6e6;
}
.btn-delete-user {
    background-color: #fbebeb;
    color: #ef4444;
}
.btn-delete-user:hover {
    background-color: #f5dada;
}

/* Ukuran tombol seragam */
.table-custom td .btn-custom {
    min-width: 85px;
    padding: 0.5rem 1rem;
}

/* Badge Role */
.role-badge {
    padding: 0.3em 0.8em;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.8rem;
}
.role-admin { background-color: #bdc3c7; color: #2c3e50; }
.role-user { background-color: #ecf0f1; color: #34495e; }

/* Responsive Scroll */
.table-responsive {
    overflow-x: auto;
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
                                        <td>
                                            @if($user->role === 'admin')
                                                <span class="role-badge role-admin">Admin</span>
                                            @else
                                                <span class="role-badge role-user">User</span>
                                            @endif
                                        </td>
                                        <td class=" text-nowrap">
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-custom btn-view-user">View</a>

                                            @if(Auth::user()->id !== $user->id && $user->role !== 'admin')
                                                {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-custom btn-delete-user" onclick="return confirm('Anda yakin ingin menghapus pengguna ini?');">Delete</button>
                                                </form> --}}
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
