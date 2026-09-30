<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FIXMATE - Diagnose. Repair. Connect.')</title>
    
    <!-- Premium Professional Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @yield('styles')
</head>
<body>
    <nav class="navbar">
        <div class="container">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="logo">
                @elseif(Auth::user()->role === 'technician')
                    <a href="{{ route('technician.dashboard') }}" class="logo">
                @else
                    <a href="{{ route('user.dashboard') }}" class="logo">
                @endif
            @else
                <a href="{{ url('/') }}" class="logo">
            @endauth
                <i class="fa-solid fa-wrench"></i> FIX<span>MATE</span>
            </a>
            
            <div class="nav-links">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                @else
                    <span style="color: var(--text-main); font-weight: 500; margin-right: 1rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-circle-user" style="font-size: 1.25rem; color: var(--primary);"></i>
                        Halo, {{ explode(' ', Auth::user()->name)[0] }}
                    </span>
                    
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline" style="border-color: var(--danger); color: var(--danger);">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Brand Col -->
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="logo" style="font-size: 1.5rem;">
                        <i class="fa-solid fa-wrench"></i> FIX<span>MATE</span>
                    </a>
                    <p>Platform AI Expert System terdepan di Indonesia untuk mendiagnosis dan memperbaiki perangkat elektronik Anda secara instan, aman, dan transparan.</p>
                    
                    <div class="social-links mt-3">
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-github"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Links Col 1 -->
                <div class="footer-col">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="#">Diagnosis AI</a></li>
                        <li><a href="#">Cari Teknisi</a></li>
                        <li><a href="#">Panduan Perbaikan</a></li>
                        <li><a href="#">Konsultasi Online</a></li>
                    </ul>
                </div>

                <!-- Links Col 2 -->
                <div class="footer-col">
                    <h4>Perusahaan</h4>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Karir Teknisi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <!-- Contact Col -->
                <div class="footer-col">
                    <h4>Hubungi Kami</h4>
                    <div class="contact-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Horizon University Indonesia<br>Karawang, Jawa Barat<br>Indonesia</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa-solid fa-phone"></i>
                        <span>0896-7145-1167</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa-solid fa-envelope"></i>
                        <span>dewapermana09@gmail.com</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} <strong>FIXMATE</strong>. Dikembangkan oleh Team Developer Ujang Deploy. Hak Cipta Dilindungi Undang-Undang.</p>
                <p>Build Version 1.0 (Laravel 12 Architecture)</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
