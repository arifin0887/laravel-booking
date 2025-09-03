<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Application</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts - Playfair Display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@404;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0ede8; /* Warna latar belakang umum */
        }
        .navbar-custom {
            background-color: #7c5e3c; /* Warna navbar */
            border-bottom: 3px solid #d4a373;
        }
        .navbar-custom .nav-link {
            color: #fffbe9; /* Warna teks link navbar */
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }
        .navbar-custom .nav-link:hover {
            color: #e6d3b3; /* Warna teks link navbar saat hover */
        }
        .navbar-custom .navbar-brand {
            color: #fffbe9;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        .card-header-custom {
            background-color: #e6d3b3;
            color: #7c5e3c;
            font-family: 'Playfair Display', serif;
        }
        .btn-custom-primary {
            background-color: #7c5e3c;
            color: #fffbe9;
            font-family: 'Playfair Display', serif;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-custom-primary:hover {
            background-color: #5c432d;
            color: #fffbe9;
        }
        .btn-custom-secondary {
            background-color: #d4a373;
            color: #fffbe9;
            font-family: 'Playfair Display', serif;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-custom-secondary:hover {
            background-color: #b88a5e;
            color: #fffbe9;
        }
        .btn-custom-danger {
            background-color: #c0392b;
            color: #fffbe9;
            font-family: 'Playfair Display', serif;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-custom-danger:hover {
            background-color: #a53023;
            color: #fffbe9;
        }
        .form-control-custom {
            background-color: #fffbe9;
            border-color: #e6d3b3;
            color: #7c5e3c;
        }
        .form-control-custom:focus {
            border-color: #7c5e3c;
            box-shadow: 0 0 0 0.25rem rgba(124, 94, 60, 0.25);
        }
        .table-custom thead {
            background-color: #e6d3b3;
            color: #7c5e3c;
            font-family: 'Playfair Display', serif;
        }
        .table-custom tbody tr:nth-child(even) {
            background-color: #fdfaf5;
        }
        .table-custom tbody tr:nth-child(odd) {
            background-color: #fffbe9;
        }
        .table-custom th, .table-custom td {
            border-color: #e6d3b3;
            vertical-align: middle;
        }
        .footer {
            background-color: #7c5e3c;
            color: #fffbe9;
            padding: 1rem 0;
            text-align: center;
            margin-top: auto; /* Untuk menempatkan footer di bagian bawah */
            font-family: 'Playfair Display', serif;
            border-top: 3px solid #d4a373;
        }
        html, body {
            height: 100%;
        }
        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        

        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>

        
    </div>

    <!-- Bootstrap JS (bundle includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>