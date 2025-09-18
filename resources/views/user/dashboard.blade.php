<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookingApp</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Kita nonaktifkan Vite untuk memastikan tidak ada error --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Bootstrap 5 JS & CSS (Hanya untuk fungsionalitas) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #5d4037;
            --brand-primary-hover: #4e342e;
            --brand-accent: #c5a47e;
            --brand-text: #3e2723;
            --bg-light: #f8f6f3; /* Latar belakang lebih cerah */
            --bg-white: #ffffff;
            --border-color: #e0e0e0;
            --text-muted: #888888;
        }

        /* 
        =========================================================
        --- STYLE BARU UNTUK KESELURUHAN TAMPILAN "WOW" ---
        =========================================================
        */

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            /* Latar belakang baru dengan tekstur halus */
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23e0d7cb" fill-opacity="0.2"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
            color: var(--brand-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex-grow: 1;
        }

        /* --- Header "WOW" Baru --- */
        .main-header {
            background-color: var(--bg-white);
            color: var(--brand-text);
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-bottom: 1px solid var(--border-color);
            position: sticky; /* Tetap di atas saat scroll */
            top: 0;
            z-index: 100;
        }
        .main-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        .main-header .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        .main-header .logo-icon { color: var(--brand-primary); }
        .main-header .logo-text { font-size: 1.5rem; font-weight: 700; color: var(--brand-text); }
        .main-header .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .main-header .nav-link {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            padding-bottom: 4px;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }
        .main-header .nav-link:hover, .main-header .nav-link.active {
            color: var(--brand-primary);
            border-bottom-color: var(--brand-primary);
        }
        .btn-logout {
            background-color: var(--brand-primary);
            color: white;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-logout:hover {
            background-color: var(--brand-primary-hover);
            box-shadow: 0 4px 15px rgba(93, 64, 55, 0.2);
            transform: translateY(-2px);
        }

        /* --- Footer --- */
        .main-footer {
            background-color: var(--brand-primary);
            color: white;
            padding: 1rem 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <header class="main-header">
        <div class="container">
            <a class="logo-container" href="{{ url('/') }}">
                <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L8.707 1.5Z"/><path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/></svg>
                <span class="logo-text">BookingApp</span>
            </a>
            <div class="nav-actions">
                @auth
                    <a class="nav-link active" href="#">Dashboard</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-logout">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
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