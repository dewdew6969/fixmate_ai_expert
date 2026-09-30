@extends('layouts.app')

@section('content')
<div class="container" style="display: flex; align-items: center; justify-content: center; min-height: 80vh; padding: 4rem 0;">
    <div class="glass-card" style="width: 100%; max-width: 550px; padding: 3rem;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <h2 style="font-size: 2rem; margin-bottom: 0.5rem;">Buat Akun FIXMATE</h2>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Bergabunglah untuk mendiagnosis perangkat atau menjadi teknisi.</p>
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

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 1.25rem;">
                <label class="form-label" for="name" style="font-weight: 500; margin-bottom: 0.5rem; font-size: 0.95rem;">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="John Doe" style="width: 100%; padding: 0.875rem 1rem; background: rgba(6, 16, 30, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-main); transition: var(--transition);">
            </div>

            <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 1.25rem;">
                <label class="form-label" for="email" style="font-weight: 500; margin-bottom: 0.5rem; font-size: 0.95rem;">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required placeholder="nama@email.com" style="width: 100%; padding: 0.875rem 1rem; background: rgba(6, 16, 30, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-main); transition: var(--transition);">
            </div>

            <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 1.25rem;">
                <label class="form-label" for="phone" style="font-weight: 500; margin-bottom: 0.5rem; font-size: 0.95rem;">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="08123456789" style="width: 100%; padding: 0.875rem 1rem; background: rgba(6, 16, 30, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-main); transition: var(--transition);">
            </div>

            <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 1.25rem;">
                <label class="form-label" for="role" style="font-weight: 500; margin-bottom: 0.5rem; font-size: 0.95rem;">Mendaftar Sebagai</label>
                <select name="role" id="role" class="form-control" required style="width: 100%; padding: 0.875rem 1rem; background: rgba(6, 16, 30, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-main); transition: var(--transition); cursor: pointer; appearance: auto;">
                    <option value="user" {{ request('role') !== 'technician' ? 'selected' : '' }}>Pengguna Biasa (Ingin memperbaiki perangkat)</option>
                    <option value="technician" {{ request('role') === 'technician' ? 'selected' : '' }}>Mitra Teknisi</option>
                </select>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2.5rem;">
                <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 0;">
                    <label class="form-label" for="password" style="font-weight: 500; margin-bottom: 0.5rem; font-size: 0.95rem;">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Minimal 8 karakter" style="width: 100%; padding: 0.875rem 1rem; background: rgba(6, 16, 30, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-main); transition: var(--transition);">
                </div>
                
                <div class="form-group" style="display: flex; flex-direction: column; margin-bottom: 0;">
                    <label class="form-label" for="password_confirmation" style="font-weight: 500; margin-bottom: 0.5rem; font-size: 0.95rem;">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Ketik ulang password" style="width: 100%; padding: 0.875rem 1rem; background: rgba(6, 16, 30, 0.6); border: 1px solid var(--border-color); border-radius: 8px; color: var(--text-main); transition: var(--transition);">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.05rem;">
                <i class="fa-solid fa-user-plus" style="margin-right: 0.5rem;"></i> Daftar Sekarang
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 2rem;">
            <p style="color: var(--text-muted); font-size: 0.95rem;">
                Sudah punya akun? <a href="{{ route('login') }}" style="font-weight: 600; color: var(--primary);">Masuk di sini</a>
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
    select.form-control option {
        background: var(--bg-dark);
        color: var(--text-main);
    }
</style>
@endsection
