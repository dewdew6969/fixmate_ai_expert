@extends('layouts.app')

@section('content')
<div style="display: flex; min-height: 100vh;">
    <!-- Sidebar -->
    <div style="width: 280px; background: rgba(4, 10, 18, 0.9); border-right: 1px solid rgba(255,255,255,0.05); padding: 2rem 1.5rem;">
        <h3 style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-bottom: 1.5rem;">Menu Administrator</h3>
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li style="margin-bottom: 0.5rem;">
                <a href="#" style="display: flex; align-items: center; gap: 1rem; padding: 0.875rem 1rem; background: rgba(37,99,235,0.1); color: var(--primary); border-radius: 8px; font-weight: 500;">
                    <i class="fa-solid fa-chart-line" style="width: 20px;"></i> Overview
                </a>
            </li>
            <li style="margin-bottom: 0.5rem;">
                <a href="#" style="display: flex; align-items: center; gap: 1rem; padding: 0.875rem 1rem; color: var(--text-muted); border-radius: 8px; transition: var(--transition);">
                    <i class="fa-solid fa-users" style="width: 20px;"></i> Kelola Pengguna
                </a>
            </li>
            <li style="margin-bottom: 0.5rem;">
                <a href="#" style="display: flex; align-items: center; gap: 1rem; padding: 0.875rem 1rem; color: var(--text-muted); border-radius: 8px; transition: var(--transition);">
                    <i class="fa-solid fa-user-gear" style="width: 20px;"></i> Verifikasi Teknisi
                </a>
            </li>
            <li style="margin-bottom: 2rem;">
                <a href="#" style="display: flex; align-items: center; gap: 1rem; padding: 0.875rem 1rem; color: var(--text-muted); border-radius: 8px; transition: var(--transition);">
                    <i class="fa-solid fa-file-invoice-dollar" style="width: 20px;"></i> Laporan Transaksi
                </a>
            </li>
        </ul>

        <h3 style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-bottom: 1.5rem;">Basis Pengetahuan (AI)</h3>
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li style="margin-bottom: 0.5rem;">
                <a href="#" style="display: flex; align-items: center; gap: 1rem; padding: 0.875rem 1rem; color: var(--text-muted); border-radius: 8px; transition: var(--transition);">
                    <i class="fa-solid fa-laptop-medical" style="width: 20px;"></i> Kategori & Perangkat
                </a>
            </li>
            <li style="margin-bottom: 0.5rem;">
                <a href="#" style="display: flex; align-items: center; gap: 1rem; padding: 0.875rem 1rem; color: var(--text-muted); border-radius: 8px; transition: var(--transition);">
                    <i class="fa-solid fa-viruses" style="width: 20px;"></i> Data Gejala (Symptoms)
                </a>
            </li>
            <li style="margin-bottom: 0.5rem;">
                <a href="#" style="display: flex; align-items: center; gap: 1rem; padding: 0.875rem 1rem; color: var(--text-muted); border-radius: 8px; transition: var(--transition);">
                    <i class="fa-solid fa-brain" style="width: 20px;"></i> Rules Engine & Logika
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div style="flex: 1; padding: 3rem; background: var(--bg-dark);">
        <div class="d-flex justify-between align-center mb-5">
            <div>
                <h1 style="font-size: 2rem; margin-bottom: 0.25rem;">Command Center</h1>
                <p style="color: var(--text-muted); margin: 0;">Pantau seluruh aktivitas platform FIXMATE secara real-time.</p>
            </div>
            <button class="btn btn-outline"><i class="fa-solid fa-download"></i> Unduh Laporan</button>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 3rem;">
            <div class="glass-card" style="padding: 1.5rem;">
                <h4 style="color: var(--text-muted); font-weight: 500; margin-bottom: 1rem; font-size: 0.95rem;">Total Pengguna</h4>
                <div class="d-flex align-center justify-between">
                    <h2 style="font-size: 2.5rem; margin: 0; color: #fff;">1,284</h2>
                    <div style="padding: 0.5rem; background: rgba(16,185,129,0.1); color: var(--success); border-radius: 8px; font-size: 0.85rem; font-weight: 600;">
                        <i class="fa-solid fa-arrow-trend-up"></i> +12%
                    </div>
                </div>
            </div>

            <div class="glass-card" style="padding: 1.5rem;">
                <h4 style="color: var(--text-muted); font-weight: 500; margin-bottom: 1rem; font-size: 0.95rem;">Teknisi Aktif</h4>
                <div class="d-flex align-center justify-between">
                    <h2 style="font-size: 2.5rem; margin: 0; color: #fff;">142</h2>
                    <div style="padding: 0.5rem; background: rgba(16,185,129,0.1); color: var(--success); border-radius: 8px; font-size: 0.85rem; font-weight: 600;">
                        <i class="fa-solid fa-arrow-trend-up"></i> +5%
                    </div>
                </div>
            </div>

            <div class="glass-card" style="padding: 1.5rem;">
                <h4 style="color: var(--text-muted); font-weight: 500; margin-bottom: 1rem; font-size: 0.95rem;">Diagnosis AI Selesai</h4>
                <div class="d-flex align-center justify-between">
                    <h2 style="font-size: 2.5rem; margin: 0; color: #fff;">5,892</h2>
                    <div style="padding: 0.5rem; background: rgba(37,99,235,0.1); color: var(--primary); border-radius: 8px; font-size: 0.85rem; font-weight: 600;">
                        <i class="fa-solid fa-bolt"></i> Real-time
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card" style="padding: 2rem;">
            <div class="d-flex justify-between align-center mb-4">
                <h3 style="margin: 0; font-size: 1.25rem;">Aktivitas Terbaru</h3>
                <a href="#" style="font-size: 0.9rem;">Lihat Semua Log</a>
            </div>
            
            <div style="border-top: 1px solid rgba(255,255,255,0.05); padding: 1rem 0; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(37,99,235,0.1); color: var(--primary); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0 0 0.25rem 0; font-size: 0.95rem; font-weight: 500;">Diagnosis AC Rusak Selesai</h4>
                        <p style="margin: 0; font-size: 0.85rem; color: var(--text-muted);">Sistem Pakar AI berhasil mendiagnosis kebocoran freon.</p>
                    </div>
                </div>
                <span style="font-size: 0.85rem; color: var(--text-muted);">2 menit lalu</span>
            </div>

            <div style="border-top: 1px solid rgba(255,255,255,0.05); padding: 1rem 0; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(16,185,129,0.1); color: var(--success); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0 0 0.25rem 0; font-size: 0.95rem; font-weight: 500;">Pekerjaan Selesai</h4>
                        <p style="margin: 0; font-size: 0.85rem; color: var(--text-muted);">Teknisi Budi telah menyelesaikan perbaikan Kulkas LG.</p>
                    </div>
                </div>
                <span style="font-size: 0.85rem; color: var(--text-muted);">15 menit lalu</span>
            </div>
            
            <div style="border-top: 1px solid rgba(255,255,255,0.05); padding: 1rem 0; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(245,158,11,0.1); color: var(--warning); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0 0 0.25rem 0; font-size: 0.95rem; font-weight: 500;">Teknisi Baru Mendaftar</h4>
                        <p style="margin: 0; font-size: 0.85rem; color: var(--text-muted);">Menunggu verifikasi KTP dan Sertifikat dari admin.</p>
                    </div>
                </div>
                <span style="font-size: 0.85rem; color: var(--text-muted);">1 jam lalu</span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Admin sidebar link hover effect */
    ul li a:hover {
        background: rgba(255,255,255,0.03);
        color: #fff !important;
    }
</style>
@endsection
