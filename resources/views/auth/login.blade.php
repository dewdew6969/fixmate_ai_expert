@extends('layouts.app')

@section('content')
<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 100px);">
    <div class="glass-card" style="width: 100%; max-width: 450px;">
        <h2 class="text-center mb-1">Selamat Datang Kembali</h2>
        <p class="text-center mb-4">Masuk untuk melanjutkan ke akun FIXMATE Anda.</p>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid var(--danger); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; color: #fff;">
                <ul style="list-style-type: none; margin: 0; padding: 0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
            </div>

            <div class="form-group mb-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                Masuk
            </button>
        </form>

        <p class="text-center mt-4 mb-0">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </div>
</div>
@endsection
