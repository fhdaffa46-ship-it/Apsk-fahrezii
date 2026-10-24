@extends('layouts.auth')
@section('title', 'Login Siswa - APSS')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap');

    :root {
        --ink: #15213a;
        --ink-soft: #26365a;
        --paper: #faf7f1;
        --paper-dim: #efe9dd;
        --orange: #e8622c;
        --orange-soft: #f2946b;
        --slate: #5b6b7c;
        --slate-light: #93a1b0;
        --danger: #c0392b;
    }

    * { box-sizing: border-box; }

    body {
        background: var(--ink);
        background-image:
            linear-gradient(var(--ink-soft) 1px, transparent 1px),
            linear-gradient(90deg, var(--ink-soft) 1px, transparent 1px);
        background-size: 44px 44px;
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background: radial-gradient(ellipse at 50% 30%, rgba(21,33,58,0) 0%, var(--ink) 78%);
        pointer-events: none;
        z-index: 0;
    }

    /* ===== WAVE BACKGROUND ===== */
    .wave-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 280px;
        z-index: 0;
        overflow: hidden;
        pointer-events: none;
    }

    .wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 200%;
        height: 100%;
        background-repeat: repeat-x;
        animation: waveMove 18s linear infinite;
    }

    .wave:nth-child(1) {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320' preserveAspectRatio='none'%3E%3Cpath fill='%23e8622c' fill-opacity='0.18' d='M0,192L48,176C96,160,192,128,288,133.3C384,139,480,181,576,186.7C672,192,768,160,864,144C960,128,1056,128,1152,149.3C1248,171,1344,213,1392,234.7L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: 50% 100%;
        opacity: 0.7;
        animation-duration: 22s;
        bottom: -10px;
    }

    .wave:nth-child(2) {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320' preserveAspectRatio='none'%3E%3Cpath fill='%23e8622c' fill-opacity='0.12' d='M0,256L48,240C96,224,192,192,288,181.3C384,171,480,181,576,192C672,203,768,213,864,197.3C960,181,1056,139,1152,133.3C1248,128,1344,160,1392,176L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: 50% 100%;
        animation-duration: 16s;
        animation-direction: reverse;
        bottom: 20px;
        opacity: 0.6;
    }

    .wave:nth-child(3) {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320' preserveAspectRatio='none'%3E%3Cpath fill='%2326365a' fill-opacity='0.35' d='M0,128L48,144C96,160,192,192,288,186.7C384,181,480,139,576,128C672,117,768,139,864,165.3C960,192,1056,224,1152,213.3C1248,203,1344,149,1392,122.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: 50% 100%;
        animation-duration: 28s;
        bottom: -30px;
        opacity: 0.5;
    }

    @keyframes waveMove {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ===== LOGIN CARD ===== */
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        position: relative;
        z-index: 1;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
        background: var(--paper);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(0,0,0,0.35);
        position: relative;
    }

    /* Soft wave at the bottom of the card */
    .login-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 18px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 20' preserveAspectRatio='none'%3E%3Cpath fill='%23efe9dd' d='M0,12 C40,4 80,16 120,10 C160,4 200,18 240,12 C280,6 320,16 360,10 C380,7 390,9 400,12 L400,20 L0,20 Z'/%3E%3C/svg%3E");
        background-size: 100% 100%;
        pointer-events: none;
    }

    .card-header {
        padding: 2.4rem 2.2rem 1.4rem;
        text-align: center;
        border-bottom: 1px dashed #d8d0bf;
        position: relative;
    }

    .logo-badge {
        width: 52px;
        height: 52px;
        background: var(--orange);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: #fff;
        letter-spacing: -0.02em;
        box-shadow: 0 8px 20px rgba(232, 98, 44, 0.35);
    }

    .login-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 0.4rem;
        letter-spacing: -0.01em;
    }

    .login-subtitle {
        color: var(--slate);
        font-size: 0.92rem;
        margin: 0;
        line-height: 1.5;
    }

    .form-section {
        padding: 1.8rem 2.2rem 0.5rem;
    }

    .form-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--slate);
        margin-bottom: 0.5rem;
        display: block;
    }

    .input-wrapper {
        position: relative;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px 14px 46px;
        border: 1.5px solid #e2dbca;
        border-radius: 10px;
        background: #fff;
        font-size: 1rem;
        font-weight: 500;
        color: var(--ink);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(232,98,44,0.15);
        outline: none;
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.05rem;
        color: var(--slate-light);
        z-index: 2;
        transition: color 0.2s ease;
    }

    .form-control:focus ~ .input-icon {
        color: var(--orange);
    }

    .form-control::placeholder {
        color: #a8a196;
        font-weight: 400;
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.82rem;
        margin: 0.4rem 0 1rem 2px;
    }

    .btn-login {
        width: 100%;
        padding: 14px;
        border-radius: 10px;
        background: var(--orange);
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        box-shadow: 0 8px 20px rgba(232,98,44,0.3);
        transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        margin-top: 1.5rem;
        margin-bottom: 1.8rem;
        position: relative;
        overflow: hidden;
    }

    .btn-login:hover {
        background: #d1531e;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(232,98,44,0.4);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .login-footer {
        padding: 1.3rem 2.2rem 1.8rem;
        text-align: center;
        border-top: 1px solid var(--paper-dim);
        background: var(--paper-dim);
        position: relative;
        z-index: 1;
    }

    .login-footer p {
        font-size: 0.88rem;
        color: var(--slate);
        margin: 0;
    }

    .login-link {
        color: var(--ink);
        font-weight: 600;
        text-decoration: none;
        border-bottom: 1.5px solid var(--orange);
        transition: color 0.2s ease;
    }

    .login-link:hover {
        color: var(--orange);
    }

    .error-message {
        background: #fbeae8;
        border: 1px solid #f0c4bd;
        color: var(--danger);
        border-radius: 8px;
        padding: 10px 14px;
        margin-bottom: 1rem;
        font-size: 0.86rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    @media (max-width: 480px) {
        .login-card { margin: 0 0.5rem; }
        .card-header { padding: 2rem 1.6rem 1.2rem; }
        .form-section { padding: 1.6rem 1.6rem 0.5rem; }
        .login-footer { padding: 1.2rem 1.6rem 1.6rem; }
        .wave-container { height: 180px; }
    }
</style>

<!-- Animated Waves -->
<div class="wave-container">
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
</div>

<div class="login-wrapper">
    <div class="login-card">
        <div class="card-header">
            <div class="logo-badge">APSK</div>
            <h4 class="login-title">Masuk ke APSK</h4>
            <p class="login-subtitle">Masukkan NPM kamu untuk melaporkan kerusakan fasilitas Kampus</p>
        </div>

        <div class="form-section">
            @if ($errors->any())
                <div class="error-message">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="post" action="{{ route('siswa.login') }}">
                @csrf

                <label class="form-label" for="nis">Nomor Pokok Mahasiswa</label>
                <div class="input-wrapper">
                    <input
                        type="text"
                        id="nis"
                        class="form-control @error('nis') is-invalid @enderror"
                        name="nis"
                        placeholder="Contoh: 2425108"
                        value="{{ old('nis') }}"
                        autocomplete="username"
                        required
                    >
                    <i class="bi bi-person input-icon"></i>
                </div>

                @error('nis')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}
                    </div>
                @enderror

                <div class="d-grid">
                    <button type="submit" class="btn btn-login">Masuk Sekarang</button>
                </div>
            </form>
        </div>

        <div class="login-footer">
            <p>
                Belum punya akun?
                <a href="{{ route('siswa.register') }}" class="login-link">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection