<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookingApp - Admin Panel</title>

    <!-- Fonts (disamakan dengan landing page) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Kita nonaktifkan Vite untuk memastikan tidak ada error --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Bootstrap 5 JS & CSS (Hanya untuk fungsionalitas Modal) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #5d4037;   /* Coklat Tua dari landing page */
            --brand-background: #f5f2e9; /* Latar Belakang Krem dari landing page */
            --brand-text: #3e2723;      /* Teks Gelap dari landing page */
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--brand-background);
            color: var(--brand-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex-grow: 1;
        }
        .main-header, .main-footer {
            background-color: var(--brand-primary);
            color: white;
        }
        .main-header .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
        }
        .main-header .nav-link {
            color: rgba(255,255,255,0.8);
            font-weight: 500;
            margin: 0 0.5rem;
        }
        .main-header .nav-link:hover {
            color: white;
        }
        .main-footer {
            padding: 1rem 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <header class="main-header shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <a class="navbar-brand" href="{{ url('/') }}">BookingApp</a>
            <div class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('rooms.index') }}">Room</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Guest</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="py-5">
        @yield('content')
    </main>

    <footer class="main-footer">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Booking Application. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>