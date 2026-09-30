@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-between align-center mb-4">
        <div>
            <h2>Admin Control Panel</h2>
            <p>Sistem Pakar & Manajemen Platform</p>
        </div>
    </div>

    <div class="feature-grid">
        <div class="glass-card">
            <h3><i class="fa-solid fa-database"></i> Knowledge Base</h3>
            <ul style="list-style-type: none; padding: 0; margin-top: 1rem;">
                <li class="mb-1"><a href="{{ route('admin.categories.index') }}">Kelola Kategori</a></li>
                <li class="mb-1"><a href="{{ route('admin.devices.index') }}">Kelola Perangkat</a></li>
                <li class="mb-1"><a href="{{ route('admin.symptoms.index') }}">Kelola Gejala & Pertanyaan</a></li>
                <li class="mb-1"><a href="{{ route('admin.diagnoses.index') }}">Kelola Diagnosis & Solusi</a></li>
                <li class="mb-1"><a href="{{ route('admin.rules.index') }}">Kelola Rule Sistem Pakar</a></li>
                <li class="mb-1"><a href="{{ route('admin.repair-guides.index') }}">Kelola Panduan Perbaikan</a></li>
            </ul>
        </div>

        <div class="glass-card">
            <h3><i class="fa-solid fa-users-gear"></i> Manajemen User</h3>
            <ul style="list-style-type: none; padding: 0; margin-top: 1rem;">
                <li class="mb-1"><a href="#">Verifikasi Teknisi</a></li>
                <li class="mb-1"><a href="#">Daftar Pengguna</a></li>
                <li class="mb-1"><a href="#">Riwayat Konsultasi</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
