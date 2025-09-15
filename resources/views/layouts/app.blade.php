<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html> --}}

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

    @include('partials.navbar')

    <main class="py-5">
        @yield('content')
    </main>

    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
