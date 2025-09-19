<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - BookingApp</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Baris @vite sengaja dinonaktifkan untuk menghilangkan error Anda --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- CSS LENGKAP UNTUK TAMPILAN REGISTRASI "WOW" -->
    <style>
        :root {
            --brand-primary: #5d4037;
            --brand-primary-hover: #4e342e;
            --brand-text: #3e2723;
            --bg-white: #ffffff;
            --border-color: #e0d7cb;
            --text-muted: #888888;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; overflow: hidden; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--brand-text);
            line-height: 1.6;
        }

        /* --- Animasi --- */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Latar Belakang Kolase Buram --- */
        .background-wrapper {
            position: fixed;
            inset: -2%;
            z-index: -2;
            filter: blur(8px) brightness(0.9);
            transform: scale(1.1);
        }
        .background-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
        }
        .grid-item img {
            width: 100%;
            height: auto;
            border-radius: 1rem;
        }
        
        /* --- Header --- */
        .main-header {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            z-index: 100;
            background: rgba(42, 32, 28, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .main-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
            max-width: 1200px;
            width: 100%; 
            margin: 0 auto; 
            padding: 0 2rem; /* Padding agar tidak mepet */
        }
        .main-header .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        .main-header .logo-icon { color: var(--bg-white); }
        .main-header .logo-text { font-size: 1.5rem; font-weight: 700; color: var(--bg-white); }
        .btn-back-home {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-back-home:hover {
            background: rgba(255,255,255,0.2);
        }
        
        /* --- Kartu Registrasi --- */
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            padding-top: 70px;
        }
        .login-modal {
            width: 100%;
            max-width: 450px;
            background: var(--bg-white);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: fadeInUp 0.7s ease-out;
            overflow: hidden;
        }
        .modal-header-custom {
            background-color: var(--brand-primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .modal-header-custom h2 { font-size: 1.75rem; font-weight: 700; }
        .modal-header-custom p { color: rgba(255,255,255,0.8); margin: 0; }
        .modal-body-custom {
            padding: 2.5rem;
        }
        
        .input-group { position: relative; margin-bottom: 1.5rem; }
        .form-label-custom {
            font-weight: 500;
            color: var(--text-muted);
            position: absolute;
            top: 0.8rem;
            left: 0.25rem;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        .form-control-custom {
            width: 100%;
            border: none;
            border-bottom: 2px solid var(--border-color);
            padding: 0.75rem 0.25rem;
            font-size: 1rem;
            background: transparent;
        }
        .form-control-custom:focus {
            outline: none;
            border-bottom-color: var(--brand-primary);
        }
        .form-control-custom:focus ~ .form-label-custom,
        .form-control-custom:not(:placeholder-shown) ~ .form-label-custom {
            transform: translateY(-1.5rem) scale(0.8);
            color: var(--brand-primary);
        }
        
        .btn-register-form {
            width: 100%;
            background: var(--brand-primary);
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 0.9rem;
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: 1.5rem;
        }
        .btn-register-form:hover {
            background-color: var(--brand-primary-hover);
            box-shadow: 0 5px 20px rgba(93, 64, 55, 0.3);
            transform: translateY(-3px);
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-muted);
        }
        .login-link a {
            color: var(--brand-text);
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>
<body>
    
    <div class="background-wrapper">
        <div class="background-grid">
            <!-- Gambar-gambar untuk kolase -->
            <div><div class="grid-item"><img src="https://images.unsplash.com/photo-1562778612-e1e0cda99154?q=80&w=2006&auto=format&fit=crop"></div><div class="grid-item"><img src="https://images.unsplash.com/photo-1596436889106-be35e843f974?q=80&w=2070&auto=format&fit=crop"></div></div>
            <div><div class="grid-item"><img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f458?q=80&w=2070&auto=format&fit=crop"></div><div class="grid-item"><img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=2070&auto=format&fit=crop"></div></div>
            <div><div class="grid-item"><img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=2070&auto=format&fit=crop"></div><div class="grid-item"><img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?q=80&w=2070&auto=format&fit=crop"></div></div>
            <div><div class="grid-item"><img src="https://images.unsplash.com/photo-1590490359854-dfba59585b73?q=80&w=1999&auto=format&fit=crop"></div><div class="grid-item"><img src="https://images.unsplash.com/photo-1549294413-26f195200c16?q=80&w=1964&auto=format&fit=crop"></div></div>
            <div><div class="grid-item"><img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?q=80&w=2070&auto=format&fit=crop"></div><div class="grid-item"><img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=2070&auto=format&fit=crop"></div></div>
        </div>
    </div>

    <header class="main-header">
        <div class="container">
            <a href="{{ url('/') }}" class="logo-container">
                <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L8.707 1.5Z"/><path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/></svg>
                <span class="logo-text">BookingApp</span>
            </a>
            <nav>
                <a href="{{ url('/') }}" class="btn-back-home">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
                     <span>Beranda</span>
                </a>
            </nav>
        </div>
    </header>

    <div class="login-container">
        <div class="login-modal">
            <div class="modal-header-custom">
                <h2>Buat Akun Baru</h2>
                <p>Mulai petualangan Anda bersama kami.</p>
            </div>
            
            <div class="modal-body-custom">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group">
                        <input id="name" type="text" class="form-control-custom" name="name" value="{{ old('name') }}" required autofocus placeholder=" ">
                        <label for="name" class="form-label-custom">Nama Lengkap</label>
                    </div>
                    
                    <div class="input-group">
                        <input id="email" type="email" class="form-control-custom" name="email" value="{{ old('email') }}" required placeholder=" ">
                        <label for="email" class="form-label-custom">Email</label>
                    </div>
                    
                    <div class="input-group">
                        <input id="password" type="password" class="form-control-custom" name="password" required placeholder=" ">
                        <label for="password" class="form-label-custom">Password</label>
                    </div>
                    
                    <div class="input-group">
                        <input id="password_confirmation" type="password" class="form-control-custom" name="password_confirmation" required placeholder=" ">
                        <label for="password_confirmation" class="form-label-custom">Konfirmasi Password</label>
                    </div>
                    
                    <button type="submit" class="btn-register-form">Daftar Akun</button>

                    <p class="login-link">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>
</html>