@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="d-flex justify-between align-center mb-4">
        <div>
            <h2>Proses Diagnosis</h2>
            <p>ID Konsultasi: {{ $consultation->consultation_code }}</p>
        </div>
    </div>

    <div class="glass-card mb-4" style="border-left: 4px solid var(--primary);">
        <div class="d-flex align-center gap-3">
            <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(59, 130, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary);">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div>
                <h3 style="margin-bottom: 0.25rem;">Expert System sedang menganalisis...</h3>
                <p style="margin: 0; color: var(--text-muted);">Sistem kami akan segera menanyakan beberapa hal untuk memastikan kerusakan perangkat Anda.</p>
            </div>
        </div>
    </div>

    <div class="glass-card">
        <h3>Pertanyaan Ahli</h3>
        <p>Fitur tanya-jawab sistem pakar akan muncul di sini (Belum diimplementasikan sepenuhnya pada fase UI).</p>
        
        <div class="mt-4">
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline">Kembali ke Dashboard</a>
        </div>
    </div>
</div>
@endsection
