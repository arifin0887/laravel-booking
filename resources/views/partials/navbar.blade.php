<nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container">
        {{-- Logo juga dibuat mengarah ke home --}}
        <a class="navbar-brand" href="{{ route('home') }}">BookingApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    {{-- INI PERBAIKANNYA --}}
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rooms.index') }}">Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookings.index')}}">Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index')}}">Guest</a>
                </li>
            </ul>
        </div>
    </div>
</nav>