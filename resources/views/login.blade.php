@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <i class="fas fa-archive"></i>
        </div>
        
        <h2 class="fw-bold mb-1">Selamat Datang</h2>
        <p class="text-muted mb-4">Login ke Sistem Arsip Digital</p>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('npm') is-invalid @enderror" 
                       id="npm" name="npm" placeholder="NPM" value="{{ old('npm') }}" required>
                <label for="npm"><i class="fas fa-user me-2"></i>NPM</label>
                @error('npm')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" placeholder="Password" required>
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check text-start mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label text-muted" for="remember">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>
                Masuk
            </button>
        </form>

        <div class="mt-4">
            <p class="text-muted small">
                © 2024 Sistem Arsip Digital. All rights reserved.
            </p>
        </div>
    </div>
</div>
@endsection