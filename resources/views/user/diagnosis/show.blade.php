@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-between align-center mb-4">
        <div>
            <h1 style="font-size: 2rem; margin-bottom: 0.25rem;">Hasil Analisis <span style="color: var(--primary);">AI Expert</span></h1>
            <p style="color: var(--text-muted); margin: 0;">Kode Konsultasi: <strong>{{ $consultation->consultation_code }}</strong></p>
        </div>
        <a href="{{ route('user.dashboard') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
        <!-- Left: Image & Info -->
        <div>
            <div class="glass-card" style="padding: 1.5rem; margin-bottom: 1.5rem;">
                <h4 style="margin-bottom: 1rem; color: var(--text-main); font-size: 1.1rem;"><i class="fa-solid fa-laptop-medical" style="color: var(--primary); margin-right: 0.5rem;"></i> Informasi Perangkat</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 0.5rem; color: var(--text-muted);">Perangkat: <strong style="color: #fff;">{{ $consultation->device->name }}</strong></li>
                    <li style="margin-bottom: 0.5rem; color: var(--text-muted);">Kategori: <strong style="color: #fff;">{{ $consultation->device->category->name }}</strong></li>
                    <li style="color: var(--text-muted);">Status: <span style="color: var(--success); font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Selesai Mendiagnosis</span></li>
                </ul>
            </div>

            @if($consultation->consultationImages->count() > 0)
            <div class="glass-card" style="padding: 1.5rem;">
                <h4 style="margin-bottom: 1rem; color: var(--text-main); font-size: 1.1rem;"><i class="fa-solid fa-image" style="color: var(--primary); margin-right: 0.5rem;"></i> Foto Kerusakan</h4>
                @foreach($consultation->consultationImages as $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Foto Kerusakan" style="width: 100%; border-radius: 8px; margin-bottom: 1rem;">
                    @if($image->description)
                        <p style="font-size: 0.9rem; color: var(--text-muted); margin: 0; padding: 0.75rem; background: rgba(0,0,0,0.2); border-radius: 6px;">"{{ $image->description }}"</p>
                    @endif
                @endforeach
            </div>
            @endif
        </div>

        <!-- Right: AI Result -->
        <div>
            <div class="glass-card" style="padding: 2.5rem; height: 100%;">
                <div class="d-flex align-center justify-between mb-4" style="border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
                    <h3 style="font-size: 1.5rem; margin: 0;"><i class="fa-solid fa-robot" style="color: var(--primary); margin-right: 0.5rem;"></i> Laporan Diagnosis AI</h3>
                    <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 0.5rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.9rem;">
                        <i class="fa-solid fa-bolt"></i> Analisis Cepat Selesai
                    </div>
                </div>

                <div class="ai-content" style="color: var(--text-main); line-height: 1.8; font-size: 1.05rem;">
                    @if($consultation->result)
                        {!! \Illuminate\Support\Str::markdown($consultation->result) !!}
                    @else
                        <div style="text-align: center; padding: 3rem 0;">
                            <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem; color: var(--warning); margin-bottom: 1rem;"></i>
                            <h4>Diagnosis Tidak Tersedia</h4>
                            <p style="color: var(--text-muted);">Sistem AI belum mengembalikan hasil atau terjadi kesalahan koneksi.</p>
                        </div>
                    @endif
                </div>

                <hr style="border: 0; height: 1px; background: rgba(255,255,255,0.05); margin: 2.5rem 0;">

                <div class="d-flex justify-between align-center" style="gap: 1rem;">
                    <button class="btn btn-outline" style="flex: 1;"><i class="fa-solid fa-print"></i> Cetak Laporan</button>
                    <a href="#" class="btn btn-primary" style="flex: 2; padding: 1rem;">
                        <i class="fa-solid fa-screwdriver-wrench"></i> Panggil Mitra Teknisi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling for Markdown injected from AI */
    .ai-content h1, .ai-content h2, .ai-content h3 {
        color: #fff;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    .ai-content p {
        margin-bottom: 1.25rem;
        color: var(--text-muted);
    }
    .ai-content ul, .ai-content ol {
        margin-bottom: 1.25rem;
        padding-left: 1.5rem;
        color: var(--text-muted);
    }
    .ai-content li {
        margin-bottom: 0.5rem;
    }
    .ai-content strong {
        color: #fff;
    }
    .ai-content code {
        background: rgba(255,255,255,0.1);
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        color: var(--accent);
    }
</style>
@endsection
