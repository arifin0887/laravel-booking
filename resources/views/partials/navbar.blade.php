{{-- filepath: c:\Coding\Laravel\booking\resources\views\partials\navbar.blade.php --}}
<style>
    .navbar-custom {
        background: linear-gradient(90deg, #7c5e3c 0%, #a98467 100%);
        font-family: 'Playfair Display', serif;
    }
    .navbar-custom .navbar-brand {
        color: #fffbe9 !important;
        font-size: 1.7rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .navbar-custom .nav-link {
        color: #fffbe9 !important;
        font-size: 1.1rem;
        font-weight: 500;
        margin-right: 10px;
        transition: color 0.2s;
    }
    .navbar-custom .nav-link:hover,
    .navbar-custom .nav-link.active {
        color: #d4a373 !important;
        text-decoration: underline;
    }
    .navbar-custom .navbar-toggler {
        border-color: #fffbe9;
    }
    .navbar-custom .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(124,94,60,1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
</style>
<nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">BookingApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                {{--}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}" href="{{ route('rooms.index') }}">Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('bookings.index')}}">Booking</a>
                </li> --}}

                {{-- Menu khusus untuk Admin --}}
                {{-- @auth
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index')}}">Guest</a>
                        </li>
                    @endif
                @endauth --}}

                {{-- Logout Button --}}
                @auth
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light ms-2">
                            Logout
                        </button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
