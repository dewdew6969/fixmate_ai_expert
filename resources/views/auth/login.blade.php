@extends('layouts.app')

@section('content')
<div class="container" style="display: flex; align-items: center; justify-content: center; min-height: 80vh; padding: 4rem 0;">
    <div class="glass-card" style="width: 100%; max-width: 500px; padding: 3rem;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <h2 style="font-size: 2rem; margin-bottom: 0.5rem;">Masuk ke FIXMATE</h2>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Silakan masuk untuk melanjutkan diagnosis atau mengelola perbaikan Anda.</p>
        </div>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); padding: 1rem; border-radius: 8px; margin-bottom: 2rem; color: #fff; font-size: 0.9rem;">
                <ul style="list-style-type: none; margin: 0; padding: 0;">
                    @foreach($errors->all() as $error)
                        <li><i class="fa-solid fa-circle-exclamation" style="margin-right: 0.5rem; color: var(--danger);"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 1.5rem;">
                <label class="form-label" for="email" style="font-weight: 500; margin-bottom: 0.5rem; font-size: 0.95rem;">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" style="width: 100%; padding: 0.875rem 1rem; background: rgba(6, 16, 30, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-main); transition: var(--transition);">
            </div>

            <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 2.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <label class="form-label" for="password" style="font-weight: 500; margin: 0; font-size: 0.95rem;">Password</label>
                </div>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password Anda" style="width: 100%; padding: 0.875rem 1rem; background: rgba(6, 16, 30, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-main); transition: var(--transition);">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.05rem;">
                <i class="fa-solid fa-right-to-bracket" style="margin-right: 0.5rem;"></i> Masuk
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 2rem;">
            <p style="color: var(--text-muted); font-size: 0.95rem;">
                Belum punya akun? <a href="{{ route('register') }}" style="font-weight: 600; color: var(--primary);">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: var(--primary) !important;
        background: rgba(6, 16, 30, 0.9) !important;
        outline: none;
    }
</style>
@endsection
