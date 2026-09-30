@extends('layouts.app')

@section('content')
<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 100px); padding: 3rem 1rem;">
    <div class="glass-card" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-1">Buat Akun FIXMATE</h2>
        <p class="text-center mb-4">Bergabunglah untuk mendiagnosis perangkat Anda.</p>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid var(--danger); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; color: #fff;">
                <ul style="list-style-type: none; margin: 0; padding: 0; font-size: 0.9rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="nama@email.com">
            </div>
            
            <div class="form-group">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="08123456789">
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Daftar Sebagai</label>
                <select id="role" name="role" class="form-control" required style="appearance: none; background-color: var(--bg-input);">
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Pengguna (Ingin memperbaiki perangkat)</option>
                    <option value="technician" {{ old('role') == 'technician' ? 'selected' : '' }}>Teknisi (Ingin menawarkan jasa)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required placeholder="Minimal 8 karakter">
            </div>

            <div class="form-group mb-4">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="Ketik ulang password">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center mt-4 mb-0">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection
