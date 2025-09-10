<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookingApp | Pesan Hotel & Akomodasi Terbaik</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Baris @vite sengaja dinonaktifkan untuk menghilangkan error Anda --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- CSS LENGKAP DENGAN SEMUA PERBAIKAN -->
    <style>
        :root {
            --brand-primary: #5d4037;   /* Coklat Tua */
            --brand-primary-hover: #4e342e;
            --brand-accent: #c5a47e;    /* Aksen Emas/Tan */
            --brand-text: #3e2723;      /* Teks Gelap */
            --bg-light: #f5f2e9;        /* Latar Belakang Krem */
            --bg-white: #ffffff;
            --border-color: #e0e0e0;
            --text-muted: #757575;
        }

        /* --- Global Reset & Base --- */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--brand-text);
            line-height: 1.6;
        }
        .container { width: 100%; max-width: 1100px; margin: 0 auto; padding: 0 1rem; }
        .section-padding { padding: 5rem 0; }
        
        /* --- Header / Navbar --- */
        .main-header {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            z-index: 100;
            transition: background-color 0.4s ease, box-shadow 0.4s ease;
        }
        .main-header.scrolled {
            background-color: var(--brand-primary);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .main-header .container { display: flex; justify-content: space-between; align-items: center; height: 80px; }
        .main-header .logo { font-size: 1.75rem; font-weight: 700; color: var(--bg-white); text-decoration: none; }
        .main-header nav a {
            margin-left: 1.5rem;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .main-header nav a:hover { color: var(--bg-white); }
        .btn { display: inline-block; padding: 0.6rem 1.25rem; border-radius: 8px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; border: 1px solid transparent; cursor: pointer; }
        .btn-primary { background-color: var(--brand-primary); color: white; }
        .btn-primary:hover { background-color: var(--brand-primary-hover); transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.2); }

        /* --- Hero Section --- */
        .hero {
            position: relative;
            height: 85vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-image: url('https://images.unsplash.com/photo-1564501049412-61c2a3083791?q=80&w=2232&auto=format&fit=crop');
            background-size: cover;
            background-position: center 30%;
        }
        .hero::after { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(62,39,35,0.8) 100%); }
        .hero-content { position: relative; z-index: 10; color: #fff; }
        .hero h1 { font-size: 3.5rem; font-weight: 700; margin-bottom: 1rem; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .hero p { font-size: 1.2rem; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto; }
        .hero-categories {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .category-link {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            color: #fff;
            transition: background-color 0.3s;
        }
        .category-link:hover {
            background: rgba(255,255,255,0.2);
        }

        /* 
        =========================================================
        --- KODE CSS BARU UNTUK SECTION "MENGINAP TANPA CEMAS" ---
        =========================================================
        */
        .section-heading { text-align: center; margin-bottom: 3rem; }
        .section-heading h2 { font-size: 2.5rem; font-weight: 700; }
        .section-heading p { color: var(--text-muted); max-width: 500px; margin: 0.5rem auto 0 auto; }
        
        .features-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
            gap: 2rem; 
        }
        .feature-item { 
            text-align: center; 
            background: var(--bg-white); 
            padding: 2.5rem 2rem; /* Padding lebih besar */
            border-radius: 16px; /* Sudut lebih bulat */
            box-shadow: 0 8px 30px rgba(0,0,0,0.08); 
            border: 1px solid #f0f0f0;
        }
        .feature-item .icon { 
            color: var(--brand-primary); 
            margin-bottom: 1.5rem; /* Jarak ikon ke teks lebih besar */
        }
        .feature-item h3 { 
            font-size: 1.25rem; /* Font lebih besar */
            font-weight: 600; 
            margin-bottom: 0.75rem; 
        }
        .feature-item p { 
            font-size: 1rem; /* Font lebih besar */
            color: var(--text-muted);
            line-height: 1.6;
        }
        
        /* --- Rooms Section --- */
        .rooms-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
        .room-card {
            background-color: var(--bg-white);
            border-radius: 12px;
            text-decoration: none;
            color: var(--brand-text);
            box-shadow: 0 5px 25px rgba(0,0,0,0.07);
            transition: all 0.3s ease;
        }
        .room-card:hover { transform: translateY(-8px); box-shadow: 0 12px 35px rgba(0,0,0,0.1); }
        .room-card img { width: 100%; height: 200px; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px; }
        .room-card-content { padding: 1.5rem; }
        .room-card h3 { font-size: 1.3rem; font-weight: 600; margin-bottom: 0.5rem; }
        .room-card .location { color: #777; }
        .room-card .price { font-size: 1.4rem; font-weight: 700; color: var(--brand-primary); margin-top: 1rem; }
        .room-card .price span { font-size: 0.9rem; font-weight: 400; color: #777; }
        
        .main-footer { background-color: var(--brand-text); color: rgba(255,255,255,0.7); padding: 3rem 0; text-align: center; }
    </style>
</head>

<body>
    
    <header class="main-header" id="mainHeader">
        <div class="container">
            <a href="/" class="logo">BookingApp</a>
            <nav>
                 @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="#">Masuk</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Temukan Hotel Impian Anda</h1>
                <p>Harga terbaik untuk hotel, vila, dan akomodasi lainnya di seluruh Indonesia.</p>
                <div class="hero-categories">
                    <a href="#rekomendasi" class="category-link">Populer</a>
                    <a href="#kenapa-kami" class="category-link">Kenapa Kami?</a>
                </div>
            </div>
        </section>
        
        {{-- ID "kenapa-kami" ditambahkan di sini --}}
        <section id="kenapa-kami" class="section-padding">
            <div class="container">
                <div class="section-heading">
                    <h2>Menginap Tanpa Cemas</h2>
                    <p>Kami memastikan pengalaman booking Anda aman, nyaman, dan tak terlupakan.</p>
                </div>
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></div>
                        <h3>Pilihan Terkurasi</h3>
                        <p>Setiap properti kami pilih untuk memastikan kualitas dan kenyamanan Anda.</p>
                    </div>
                     <div class="feature-item">
                        <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg></div>
                        <h3>Transaksi Aman</h3>
                        <p>Keamanan data dan pembayaran Anda adalah prioritas utama kami.</p>
                    </div>
                    <div class="feature-item">
                        <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg></div>
                        <h3>Bantuan 24/7</h3>
                        <p>Tim kami siap membantu Anda kapan pun Anda membutuhkan.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="rekomendasi" class="rooms-section section-padding" style="background-color: var(--bg-white);">
            <div class="container">
                <div class="section-heading">
                    <h2>Rekomendasi Populer</h2>
                    <p>Akomodasi yang paling disukai oleh pelanggan kami.</p>
                </div>
                <div class="rooms-grid">
                     <a href="#" class="room-card">
                        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=2070&auto=format&fit=crop" alt="The Grand Deluxe">
                        <div class="room-card-content">
                            <h3>The Grand Deluxe</h3>
                            <p class="location">Jakarta, Indonesia</p>
                            <div class="price">Rp 250.000 <span>/malam</span></div>
                        </div>
                    </a>
                    <a href="#" class="room-card">
                         <img src="https://images.unsplash.com/photo-1596436889106-be35e843f974?q=80&w=2070&auto=format&fit=crop" alt="Ocean View Villa">
                        <div class="room-card-content">
                            <h3>Ocean View Villa</h3>
                            <p class="location">Bali, Indonesia</p>
                            <div class="price">Rp 1.200.000 <span>/malam</span></div>
                        </div>
                    </a>
                    <a href="#" class="room-card">
                         <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f458?q=80&w=2070&auto=format&fit=crop" alt="Executive Suite">
                        <div class="room-card-content">
                            <h3>Executive Suite</h3>
                            <p class="location">Surabaya, Indonesia</p>
                            <div class="price">Rp 750.000 <span>/malam</span></div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} BookingApp. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('mainHeader');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        });
    </script>

</body>
</html>