@extends('layouts.auth')
@section('title', 'Register')

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
        --ease-float: cubic-bezier(.22, 1, .36, 1);
    }

    * { box-sizing: border-box; }

    /* ---------- KEYFRAMES ---------- */
    @keyframes waveMove    { from { transform: translateX(0); } to { transform: translateX(-50%); } }
    @keyframes waveBob     { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-14px); } }
    @keyframes floatY      { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-9px); } }
    @keyframes cardIn      { from { opacity: 0; transform: translateY(60px) scale(.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
    @keyframes riseIn      { from { opacity: 0; transform: translateY(26px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes gridDrift   { from { background-position: 0 0; } to { background-position: 44px 44px; } }
    @keyframes bubbleUp    {
        0%   { transform: translate(0, 0) scale(.6); opacity: 0; }
        15%  { opacity: .55; }
        50%  { transform: translate(24px, -50vh) scale(1); }
        100% { transform: translate(-18px, -108vh) scale(.8); opacity: 0; }
    }
    @keyframes shake       { 0%,100% { transform: translateX(0); } 20% { transform: translateX(-6px); } 40% { transform: translateX(6px); } 60% { transform: translateX(-4px); } 80% { transform: translateX(4px); } }
    @keyframes pulseRing   { 0% { box-shadow: 0 0 0 0 rgba(232,98,44,.5); } 100% { box-shadow: 0 0 0 16px rgba(232,98,44,0); } }
    @keyframes spin        { to { transform: rotate(360deg); } }

    /* ---------- LATAR ---------- */
    body {
        background: var(--ink);
        background-image:
            linear-gradient(var(--ink-soft) 1px, transparent 1px),
            linear-gradient(90deg, var(--ink-soft) 1px, transparent 1px);
        background-size: 44px 44px;
        animation: gridDrift 18s linear infinite;
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        position: relative;
        overflow-x: hidden;
    }

    .register-wrapper {
        min-height: 100vh;
        position: relative;
    }

    .register-wrapper::before {
        content: '';
        position: fixed;
        inset: 0;
        background: radial-gradient(ellipse at 50% 30%, rgba(21,33,58,0) 0%, var(--ink) 78%);
        pointer-events: none;
        z-index: 0;
    }

    /* gelombang di dasar halaman */
    .waves {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        height: 230px;
        overflow: hidden;
        pointer-events: none;
        z-index: 1;
    }

    .wave-layer { position: absolute; inset: 0; animation: waveBob 7s ease-in-out infinite; }
    .wave-layer svg { position: absolute; bottom: 0; left: 0; width: 200%; height: 100%; display: block; animation: waveMove 26s linear infinite; }

    .wave-layer.w1 { animation-duration: 9s; }
    .wave-layer.w1 svg { animation-duration: 30s; }
    .wave-layer.w2 { animation-duration: 6.5s; animation-delay: -2s; }
    .wave-layer.w2 svg { animation-duration: 20s; animation-direction: reverse; }
    .wave-layer.w3 { animation-duration: 5s; animation-delay: -3.5s; }
    .wave-layer.w3 svg { animation-duration: 13s; }

    /* gelembung naik pelan */
    .bubble {
        position: fixed;
        bottom: -30px;
        left: var(--x);
        width: var(--s);
        height: var(--s);
        border-radius: 50%;
        border: 1.5px solid rgba(242,148,107,.55);
        background: radial-gradient(circle at 30% 30%, rgba(242,148,107,.25), rgba(242,148,107,0));
        pointer-events: none;
        z-index: 1;
        opacity: 0;
        animation: bubbleUp var(--t) ease-in-out infinite;
        animation-delay: var(--d);
    }

    /* ---------- KARTU ---------- */
    .card-float {
        width: 100%;
        max-width: 440px;
        margin: 0 auto;
        position: relative;
        z-index: 10;
        animation: floatY 7s ease-in-out infinite;
    }
    .card-float:focus-within { animation-play-state: paused; }

    .register-card {
        width: 100%;
        border-radius: 22px;
        background: var(--paper);
        box-shadow: 0 40px 80px rgba(0,0,0,.45), 0 0 0 1px rgba(255,255,255,.06);
        overflow: hidden;
        position: relative;
        opacity: 0;
        animation: cardIn 1s var(--ease-float) .1s forwards;
    }

    /* kepala kartu bergelombang */
    .reg-head {
        position: relative;
        padding: 2.4rem 2.2rem 3.6rem;
        text-align: center;
        background: var(--ink);
        background-image: radial-gradient(circle at 80% 0%, rgba(232,98,44,.35), transparent 55%);
        overflow: hidden;
    }

    .head-wave {
        position: absolute;
        left: 0;
        bottom: -1px;
        width: 100%;
        height: 44px;
        overflow: hidden;
    }
    .head-wave svg { position: absolute; bottom: 0; left: 0; width: 200%; height: 100%; display: block; animation: waveMove 11s linear infinite; }
    .head-wave.back svg { animation-duration: 17s; animation-direction: reverse; }

    .logo-badge {
        position: relative;
        width: 58px;
        height: 58px;
        background: linear-gradient(135deg, var(--orange), var(--orange-soft));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.05rem;
        color: #fff;
        letter-spacing: -0.02em;
        box-shadow: 0 16px 30px rgba(232,98,44,.5);
        animation: floatY 4.5s ease-in-out infinite -1s;
        transition: transform .5s var(--ease-float);
    }
    .logo-badge::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        animation: pulseRing 2.2s ease-out infinite;
    }
    .logo-badge:hover { transform: rotate(-10deg) scale(1.08); }

    .register-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 .45rem 0;
        letter-spacing: -0.01em;
    }

    .register-subtitle {
        color: #b7c1d4;
        font-size: .92rem;
        margin: 0;
        line-height: 1.55;
    }

    /* ---------- FORM ---------- */
    .form-body {
        padding: 1.2rem 2.2rem .4rem;
    }

    .form-group {
        margin-bottom: 1.3rem;
        position: relative;
        opacity: 0;
        animation: riseIn .8s var(--ease-float) forwards;
        animation-delay: calc(.55s + var(--i, 0) * .12s);
    }

    .form-label {
        display: block;
        font-family: 'JetBrains Mono', monospace;
        font-size: .72rem;
        font-weight: 500;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--slate);
        margin-bottom: .5rem;
        transition: color .25s ease;
    }
    .form-group:focus-within .form-label { color: var(--orange); }

    .form-control {
        width: 100%;
        height: 50px;
        padding: 0 1rem 0 2.9rem;
        border: 1.5px solid #e2dbca;
        border-radius: 12px;
        font-size: .95rem;
        font-weight: 500;
        color: var(--ink);
        background: #fff;
        transition: border-color .25s ease, box-shadow .4s var(--ease-float), transform .4s var(--ease-float);
    }

    .form-control:hover { border-color: #cfc6b1; }

    .form-control:focus {
        outline: none;
        border-color: var(--orange);
        box-shadow: 0 0 0 4px rgba(232,98,44,.14), 0 14px 24px rgba(21,33,58,.08);
        transform: translateY(-2px);
    }

    .form-control.is-invalid {
        border-color: var(--danger);
        animation: shake .5s ease;
    }

    .form-control::placeholder { color: #a8a196; font-weight: 400; }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.05rem;
        color: var(--slate-light);
        pointer-events: none;
        transition: color .25s ease, transform .4s var(--ease-float);
    }

    .form-control:focus ~ .input-icon {
        color: var(--orange);
        transform: translateY(-50%) translateX(2px) scale(1.2) rotate(-6deg);
    }

    .error-message {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--danger);
        font-size: .8rem;
        font-weight: 500;
        margin-top: .45rem;
        animation: riseIn .4s var(--ease-float) both;
    }

    /* tombol */
    .register-card .btn-primary {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 52px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--orange), #f07a45);
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .6rem;
        box-shadow: 0 12px 26px rgba(232,98,44,.38);
        transition: transform .4s var(--ease-float), box-shadow .4s var(--ease-float);
        margin-top: .5rem;
        margin-bottom: 1.6rem;
    }

    .register-card .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -80%;
        width: 50%;
        height: 100%;
        background: linear-gradient(100deg, transparent, rgba(255,255,255,.35), transparent);
        transform: skewX(-20deg);
        transition: left .7s var(--ease-float);
    }

    .register-card .btn-primary:hover { transform: translateY(-4px); box-shadow: 0 20px 34px rgba(232,98,44,.5); }
    .register-card .btn-primary:hover::before { left: 130%; }
    .register-card .btn-primary:active { transform: translateY(0); }
    .register-card .btn-primary i { transition: transform .4s var(--ease-float); }
    .register-card .btn-primary:hover i { transform: translateX(5px); }
    .register-card .btn-primary:disabled { opacity: .85; cursor: wait; transform: none; }

    .spinner {
        width: 18px;
        height: 18px;
        border: 2.5px solid rgba(255,255,255,.4);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin .7s linear infinite;
    }

    /* ---------- BAGIAN LOGIN (pembatas gelombang) ---------- */
    .login-section {
        position: relative;
        padding: 1.2rem 2.2rem 1.8rem;
        text-align: center;
        background: var(--paper-dim);
        opacity: 0;
        animation: riseIn .8s var(--ease-float) 1.05s forwards;
    }

    .divider-wave {
        position: absolute;
        left: 0;
        top: -23px;
        width: 100%;
        height: 24px;
        overflow: hidden;
    }
    .divider-wave svg { position: absolute; bottom: 0; left: 0; width: 200%; height: 100%; display: block; animation: waveMove 9s linear infinite; }

    .login-text { color: var(--slate); font-size: .88rem; margin: 0; }

    .login-link {
        color: var(--ink);
        font-weight: 600;
        text-decoration: none;
        background: linear-gradient(var(--orange), var(--orange)) 0 100% / 100% 2px no-repeat;
        padding-bottom: 2px;
        transition: background-size .35s var(--ease-float), color .25s ease;
    }
    .login-link:hover { color: var(--orange); background-size: 100% 100%; color: #fff; }

    a:focus-visible, button:focus-visible { outline: 3px solid var(--orange-soft); outline-offset: 3px; }

    @media (max-width: 480px) {
        .card-float { padding: 0 .5rem; }
        .reg-head { padding: 2rem 1.6rem 3.4rem; }
        .form-body { padding: 1.1rem 1.6rem .4rem; }
        .login-section { padding: 1.2rem 1.6rem 1.6rem; }
        .waves { height: 160px; }
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after { animation: none !important; transition-duration: .01ms !important; }
        .register-card, .form-group, .login-section { opacity: 1 !important; }
        .bubble { display: none; }
    }
</style>

<!-- gelembung & gelombang latar -->
<div class="bubble" style="--x:8%;  --s:18px; --t:16s; --d:0s"></div>
<div class="bubble" style="--x:22%; --s:10px; --t:12s; --d:-4s"></div>
<div class="bubble" style="--x:40%; --s:24px; --t:19s; --d:-9s"></div>
<div class="bubble" style="--x:64%; --s:12px; --t:14s; --d:-2s"></div>
<div class="bubble" style="--x:80%; --s:20px; --t:17s; --d:-7s"></div>
<div class="bubble" style="--x:92%; --s:9px;  --t:11s; --d:-5s"></div>

<div class="waves" aria-hidden="true">
    <div class="wave-layer w1">
        <svg viewBox="0 0 2880 220" preserveAspectRatio="none"><path fill="rgba(38,54,90,.8)" d="M0 110 C240 30 480 30 720 110 S1200 190 1440 110 C1680 30 1920 30 2160 110 S2640 190 2880 110 V220 H0 Z"/></svg>
    </div>
    <div class="wave-layer w2">
        <svg viewBox="0 0 2880 220" preserveAspectRatio="none"><path fill="rgba(232,98,44,.28)" d="M0 140 C240 200 480 200 720 140 S1200 80 1440 140 C1680 200 1920 200 2160 140 S2640 80 2880 140 V220 H0 Z"/></svg>
    </div>
    <div class="wave-layer w3">
        <svg viewBox="0 0 2880 220" preserveAspectRatio="none"><path fill="#0f1a30" d="M0 175 C240 135 480 135 720 175 S1200 215 1440 175 C1680 135 1920 135 2160 175 S2640 215 2880 175 V220 H0 Z"/></svg>
    </div>
</div>

<div class="register-wrapper">
    <div class="d-flex justify-content-center align-items-center min-vh-100 p-3">
        <div class="card-float">
            <div class="register-card">
                <div class="reg-head">
                    <div class="logo-badge">APSK</div>
                    <h1 class="register-title">Daftar Mahasiswa</h1>
                    <p class="register-subtitle">Buat akun untuk mulai melaporkan kerusakan fasilitas kampus</p>

                    <div class="head-wave back" aria-hidden="true">
                        <svg viewBox="0 0 2880 44" preserveAspectRatio="none"><path fill="rgba(232,98,44,.85)" d="M0 26 C240 6 480 6 720 26 S1200 46 1440 26 C1680 6 1920 6 2160 26 S2640 46 2880 26 V44 H0 Z"/></svg>
                    </div>
                    <div class="head-wave" aria-hidden="true">
                        <svg viewBox="0 0 2880 44" preserveAspectRatio="none"><path fill="#faf7f1" d="M0 22 C240 42 480 42 720 22 S1200 2 1440 22 C1680 42 1920 42 2160 22 S2640 2 2880 22 V44 H0 Z"/></svg>
                    </div>
                </div>

                <div class="form-body">
                    <form method="POST" action="{{ route('siswa.register') }}" id="registerForm">
                        @csrf

                        <!-- NIS -->
                        <div class="form-group" style="--i:0">
                            <label class="form-label" for="nis">Nomor Pokok Siswa</label>
                            <div class="position-relative">
                                <input
                                    type="text"
                                    id="nis"
                                    name="nis"
                                    class="form-control @error('nis') is-invalid @enderror"
                                    placeholder="Contoh: 2425108"
                                    value="{{ old('nis', $nis ?? '') }}"
                                    required
                                >
                                <i class="bi bi-person input-icon"></i>
                            </div>
                            @error('nis')
                                <div class="error-message"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div class="form-group" style="--i:1">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <div class="position-relative">
                                <input
                                    type="text"
                                    id="nama"
                                    name="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Contoh: Daffa Fahrezi"
                                    value="{{ old('nama') }}"
                                    required
                                >
                                <i class="bi bi-card-text input-icon"></i>
                            </div>
                            @error('nama')
                                <div class="error-message"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kelas -->
                        <div class="form-group" style="--i:2">
                            <label class="form-label" for="kelas">Kelas/Jurusan</label>
                            <div class="position-relative">
                                <input
                                    type="text"
                                    id="kelas"
                                    name="kelas"
                                    class="form-control @error('kelas') is-invalid @enderror"
                                    placeholder="Contoh: Kelas A Informatika"
                                    value="{{ old('kelas') }}"
                                    required
                                >
                                <i class="bi bi-mortarboard input-icon"></i>
                            </div>
                            @error('kelas')
                                <div class="error-message"><i class="bi bi-exclamation-circle-fill"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" style="--i:3">
                            <button type="submit" class="btn btn-primary" id="registerBtn">
                                <span class="btn-label">Daftar Sekarang</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="login-section">
                    <div class="divider-wave" aria-hidden="true">
                        <svg viewBox="0 0 2880 24" preserveAspectRatio="none"><path fill="#efe9dd" d="M0 12 C240 0 480 0 720 12 S1200 24 1440 12 C1680 0 1920 0 2160 12 S2640 24 2880 12 V24 H0 Z"/></svg>
                    </div>
                    <p class="login-text">
                        Sudah punya akun?
                        <a href="{{ route('siswa.login') }}" class="login-link">Masuk sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    var form = document.getElementById('registerForm');
    var btn = document.getElementById('registerBtn');
    if (!form || !btn) return;

    // tampilkan loading saat form dikirim agar tidak terkirim dua kali
    form.addEventListener('submit', function () {
        if (!form.checkValidity()) return;
        btn.disabled = true;
        btn.querySelector('.btn-label').textContent = 'Memproses...';
        var icon = btn.querySelector('i');
        if (icon) { icon.className = 'spinner'; }
    });

    // reset tombol jika pengguna kembali lewat tombol Back
    window.addEventListener('pageshow', function (e) {
        if (e.persisted) {
            btn.disabled = false;
            btn.querySelector('.btn-label').textContent = 'Daftar Sekarang';
            var sp = btn.querySelector('.spinner');
            if (sp) { sp.className = 'bi bi-arrow-right'; }
        }
    });
})();
</script>
@endsection