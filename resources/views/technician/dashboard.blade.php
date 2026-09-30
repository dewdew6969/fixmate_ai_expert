@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-between align-center mb-4">
        <div>
            <h2>Dashboard Teknisi</h2>
            <p>Selamat datang, {{ Auth::user()->name }}!</p>
        </div>
    </div>

    <div class="feature-grid">
        <div class="glass-card">
            <h3><i class="fa-solid fa-list-check"></i> Permintaan Baru</h3>
            <p>Belum ada permintaan perbaikan dari pengguna.</p>
        </div>

        <div class="glass-card">
            <h3><i class="fa-solid fa-wrench"></i> Sedang Dikerjakan</h3>
            <p>Tidak ada perbaikan yang sedang berjalan saat ini.</p>
        </div>
        
        <div class="glass-card">
            <h3><i class="fa-solid fa-star"></i> Performa Anda</h3>
            <p>Selesaikan perbaikan untuk mendapatkan rating dan review.</p>
        </div>
    </div>
</div>
@endsection
