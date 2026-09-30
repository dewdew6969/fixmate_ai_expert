@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="container hero-content">
        <div style="display: inline-block; padding: 0.5rem 1rem; background: rgba(37, 99, 235, 0.1); border: 1px solid rgba(37, 99, 235, 0.3); border-radius: 50px; color: var(--accent); font-size: 0.875rem; font-weight: 600; margin-bottom: 2rem;">
            <i class="fa-solid fa-microchip"></i> Powered by AI Expert System
        </div>
        <h1>Diagnose. <span>Repair.</span> Connect.</h1>
        <p class="hero-subtitle">
            Platform cerdas berbasis Artificial Intelligence untuk mendiagnosis kerusakan perangkat keras Anda secara instan. Dapatkan panduan perbaikan mandiri atau terhubung langsung dengan teknisi profesional terverifikasi di kota Anda.
        </p>
        
        <div class="d-flex justify-center gap-2 mb-5">
            <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2.5rem;">Mulai Diagnosis Gratis</a>
            <a href="#how-it-works" class="btn btn-outline" style="font-size: 1.1rem; padding: 1rem 2.5rem;">Pelajari Cara Kerja</a>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="section" id="how-it-works">
    <div class="container">
        <h2 class="section-title">Bagaimana FIXMATE <span>Bekerja?</span></h2>
        <p class="section-subtitle">Tiga langkah mudah untuk menyelesaikan masalah perangkat elektronik Anda tanpa perlu keluar rumah.</p>

        <div class="feature-grid mt-5">
            <div class="glass-card">
                <i class="fa-solid fa-camera-viewfinder feature-icon"></i>
                <h3>1. Foto & Identifikasi</h3>
                <p>Gunakan kamera smartphone Anda untuk memfoto area kerusakan. Sistem AI Vision kami akan otomatis menganalisis komponen dan indikasi kerusakan fisik.</p>
            </div>
            
            <div class="glass-card">
                <i class="fa-solid fa-brain feature-icon"></i>
                <h3>2. Diagnosis Sistem Pakar</h3>
                <p>Jawab beberapa pertanyaan dinamis yang disusun oleh algoritma Forward Chaining. Sistem akan mencocokkan gejala dengan basis pengetahuan teknisi ahli.</p>
            </div>

            <div class="glass-card">
                <i class="fa-solid fa-user-gear feature-icon"></i>
                <h3>3. Solusi Instan & Teknisi</h3>
                <p>Dapatkan panduan langkah demi langkah jika aman diperbaiki sendiri, atau klik satu tombol untuk memanggil teknisi spesialis terdekat langsung ke lokasi Anda.</p>
            </div>
        </div>
    </div>
</div>

<!-- Why Us Section (Dark) -->
<div class="section section-dark">
    <div class="container">
        <div class="d-flex align-center justify-between" style="flex-wrap: wrap; gap: 4rem;">
            <div style="flex: 1; min-width: 300px;">
                <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem;">Mengapa Memilih <span style="color: var(--primary);">FIXMATE?</span></h2>
                <p style="font-size: 1.1rem; margin-bottom: 2rem;">Kami menggabungkan kecerdasan buatan dengan keahlian teknisi manusia untuk memberikan solusi perbaikan tercepat, termurah, dan paling transparan.</p>
                
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 1.5rem; display: flex; gap: 1rem;">
                        <i class="fa-solid fa-circle-check" style="color: var(--success); font-size: 1.5rem; margin-top: 0.2rem;"></i>
                        <div>
                            <h4 style="margin-bottom: 0.25rem;">Diagnosis Akurat</h4>
                            <p style="margin: 0; font-size: 0.95rem;">Tingkat akurasi diagnosis mencapai 94% berdasarkan data knowledge base pakar asli.</p>
                        </div>
                    </li>
                    <li style="margin-bottom: 1.5rem; display: flex; gap: 1rem;">
                        <i class="fa-solid fa-shield-halved" style="color: var(--success); font-size: 1.5rem; margin-top: 0.2rem;"></i>
                        <div>
                            <h4 style="margin-bottom: 0.25rem;">Teknisi Terverifikasi</h4>
                            <p style="margin: 0; font-size: 0.95rem;">Semua teknisi telah melewati tahap verifikasi identitas dan keahlian ketat.</p>
                        </div>
                    </li>
                    <li style="display: flex; gap: 1rem;">
                        <i class="fa-solid fa-hand-holding-dollar" style="color: var(--success); font-size: 1.5rem; margin-top: 0.2rem;"></i>
                        <div>
                            <h4 style="margin-bottom: 0.25rem;">Harga Transparan</h4>
                            <p style="margin: 0; font-size: 0.95rem;">Tidak ada biaya tersembunyi. Estimasi harga perbaikan langsung muncul di layar.</p>
                        </div>
                    </li>
                </ul>
            </div>
            
            <!-- Statistics/Visual Block -->
            <div style="flex: 1; min-width: 300px; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="glass-card text-center" style="padding: 2rem 1rem;">
                    <h2 style="font-size: 3rem; color: var(--primary); margin-bottom: 0.5rem;">5K+</h2>
                    <p style="margin: 0; font-weight: 500;">Diagnosis Berhasil</p>
                </div>
                <div class="glass-card text-center" style="padding: 2rem 1rem;">
                    <h2 style="font-size: 3rem; color: var(--accent); margin-bottom: 0.5rem;">24/7</h2>
                    <p style="margin: 0; font-weight: 500;">AI Assistant Aktif</p>
                </div>
                <div class="glass-card text-center" style="padding: 2rem 1rem; grid-column: span 2;">
                    <h2 style="font-size: 3rem; color: var(--success); margin-bottom: 0.5rem;">100+</h2>
                    <p style="margin: 0; font-weight: 500;">Teknisi Ahli Tersedia</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action for Technicians -->
<div class="section">
    <div class="container">
        <div class="glass-card" style="background: linear-gradient(135deg, rgba(37,99,235,0.1), rgba(12,28,56,0.9)); border-color: rgba(37,99,235,0.5); text-align: center; padding: 4rem 2rem;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem;">Apakah Anda Seorang <span style="color: var(--primary);">Teknisi?</span></h2>
            <p style="font-size: 1.1rem; max-width: 600px; margin: 0 auto 2.5rem;">Tingkatkan penghasilan Anda dengan bergabung bersama FIXMATE. Dapatkan pelanggan baru setiap hari tanpa harus mencari. Sistem kami yang akan mencarikan pelanggan untuk Anda.</p>
            <a href="{{ route('register') }}?role=technician" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2.5rem;"><i class="fa-solid fa-briefcase" style="margin-right: 0.5rem;"></i> Gabung Sebagai Mitra Teknisi</a>
        </div>
    </div>
</div>
@endsection
