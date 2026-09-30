@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-between align-center mb-5" style="border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2.25rem; margin-bottom: 0.5rem;">Dashboard <span style="color: var(--warning);">Mitra Teknisi</span></h1>
            <p style="color: var(--text-muted); font-size: 1.1rem; margin: 0;">Status Anda saat ini: <span style="color: var(--success); font-weight: 600;"><i class="fa-solid fa-circle-dot" style="font-size: 0.8rem; margin-right: 0.25rem;"></i> Online & Tersedia</span></p>
        </div>
        <div style="text-align: right;">
            <p style="margin: 0 0 0.5rem 0; font-size: 0.9rem; color: var(--text-muted);">Saldo Penghasilan</p>
            <h2 style="margin: 0; color: var(--text-main);">Rp 0 <span style="font-size: 1rem; color: var(--primary);"><i class="fa-solid fa-wallet"></i></span></h2>
        </div>
    </div>

    <!-- Stats Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div class="glass-card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(37,99,235,0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <div>
                <h3 style="font-size: 2rem; margin: 0; line-height: 1;">0</h3>
                <p style="margin: 0; color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Permintaan Baru</p>
            </div>
        </div>
        
        <div class="glass-card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(245,158,11,0.1); color: var(--warning); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                <i class="fa-solid fa-spinner"></i>
            </div>
            <div>
                <h3 style="font-size: 2rem; margin: 0; line-height: 1;">0</h3>
                <p style="margin: 0; color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Sedang Dikerjakan</p>
            </div>
        </div>

        <div class="glass-card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(16,185,129,0.1); color: var(--success); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                <i class="fa-solid fa-check-double"></i>
            </div>
            <div>
                <h3 style="font-size: 2rem; margin: 0; line-height: 1;">0</h3>
                <p style="margin: 0; color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Selesai Bulan Ini</p>
            </div>
        </div>

        <div class="glass-card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(239,68,68,0.1); color: var(--danger); display: flex; align-items: center; justify-content: center; font-size: 1.75rem;">
                <i class="fa-solid fa-star"></i>
            </div>
            <div>
                <h3 style="font-size: 2rem; margin: 0; line-height: 1;">0.0</h3>
                <p style="margin: 0; color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">Rating & Ulasan</p>
            </div>
        </div>
    </div>

    <!-- Active Jobs Section -->
    <div style="margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-clipboard-list" style="color: var(--primary);"></i> Panggilan Darurat di Area Anda</h2>
        
        <div class="glass-card text-center" style="padding: 4rem 2rem; border-style: dashed;">
            <i class="fa-solid fa-satellite-dish" style="font-size: 4rem; color: rgba(255,255,255,0.1); margin-bottom: 1.5rem;"></i>
            <h3 style="margin-bottom: 0.5rem;">Radar Aktif, Menunggu Panggilan...</h3>
            <p style="color: var(--text-muted); max-width: 500px; margin: 0 auto;">Saat ini belum ada pengguna di radius Anda yang membutuhkan perbaikan. Sistem akan memberikan notifikasi otomatis begitu ada pesanan masuk.</p>
        </div>
    </div>
</div>
@endsection
