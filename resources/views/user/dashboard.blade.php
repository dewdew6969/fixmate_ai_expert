@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-between align-center mb-5" style="border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 2rem;">
        <div>
            <h1 style="font-size: 2.25rem; margin-bottom: 0.5rem;">Dashboard <span style="color: var(--primary);">Pengguna</span></h1>
            <p style="color: var(--text-muted); font-size: 1.1rem; margin: 0;">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>!</p>
        </div>
        <div>
            <a href="{{ route('user.diagnosis.create') }}" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.05rem; border-radius: 50px;">
                <i class="fa-solid fa-plus"></i> Mulai Diagnosis Baru
            </a>
        </div>
    </div>

    <div class="feature-grid mt-4">
        <!-- Diagnosis History -->
        <div class="glass-card" style="padding: 2.5rem; display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; opacity: 0.03; font-size: 10rem; color: #fff;">
                <i class="fa-solid fa-microchip"></i>
            </div>
            <div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(37, 99, 235, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; margin: 0;">Riwayat Diagnosis</h3>
                </div>
                <p style="color: var(--text-muted); line-height: 1.6; margin-bottom: 2rem;">Sistem belum menemukan riwayat diagnosis kerusakan perangkat pada akun Anda. Mulai analisis AI pertama Anda sekarang.</p>
            </div>
            <a href="#" class="btn btn-outline" style="align-self: flex-start; border-color: rgba(255,255,255,0.1);">Lihat Semua Riwayat <i class="fa-solid fa-arrow-right" style="margin-left: 0.5rem;"></i></a>
        </div>

        <!-- Active Bookings -->
        <div class="glass-card" style="padding: 2.5rem; display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; opacity: 0.03; font-size: 10rem; color: #fff;">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); color: var(--success); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; margin: 0;">Booking Aktif</h3>
                </div>
                <div style="background: rgba(0,0,0,0.2); border: 1px dashed rgba(255,255,255,0.1); border-radius: 8px; padding: 1.5rem; text-align: center; margin-bottom: 2rem;">
                    <p style="color: var(--text-muted); margin: 0; font-size: 0.95rem;"><i class="fa-regular fa-calendar-xmark" style="margin-right: 0.5rem;"></i> Tidak ada jadwal perbaikan dengan teknisi saat ini.</p>
                </div>
            </div>
            <a href="#" class="btn btn-outline" style="align-self: flex-start; border-color: rgba(255,255,255,0.1);">Kelola Booking <i class="fa-solid fa-arrow-right" style="margin-left: 0.5rem;"></i></a>
        </div>
    </div>
</div>
@endsection
