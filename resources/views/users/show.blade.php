@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="background-color: #fffbe9;">
                <div class="card-header text-center" style="background-color: #e6d3b3;">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: #7c5e3c;">User Details</h2>
                </div>
                <div class="card-body">
                    <p><strong style="color: #7c5e3c;">Name:</strong> {{ $user->name }}</p>
                    <p><strong style="color: #7c5e3c;">Email:</strong> {{ $user->email }}</p>
                    <p><strong style="color: #7c5e3c;">Role:</strong> {{ ucfirst($user->role) }}</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection