@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-between align-center mb-4">
        <div>
            <h2>Dashboard Pengguna</h2>
            <p>Selamat datang, {{ Auth::user()->name }}!</p>
        </div>
        <a href="{{ route('user.diagnosis.create') }}" class="btn btn-primary">Mulai Diagnosis Baru</a>
    </div>

    <div class="feature-grid">
        <div class="glass-card">
            <h3><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Diagnosis</h3>
            <p>Anda belum memiliki riwayat diagnosis kerusakan perangkat.</p>
        </div>

        <div class="glass-card">
            <h3><i class="fa-solid fa-calendar-check"></i> Booking Aktif</h3>
            <p>Tidak ada jadwal perbaikan dengan teknisi saat ini.</p>
        </div>
    </div>
</div>
@endsection
