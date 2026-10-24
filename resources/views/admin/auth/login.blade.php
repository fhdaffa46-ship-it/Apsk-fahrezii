@extends('layouts.auth')
@section('title', 'Admin Login - APSS')

@section('content')
<style>
    :root {
        --admin-primary: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        --admin-secondary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --glass-bg: rgba(255, 255, 255, 0.15);
        --glass-border: rgba(255, 255, 255, 0.25);
        --input-bg: rgba(255, 255, 255, 0.95);
        --shadow-admin: 0 25px 50px rgba(78, 115, 223, 0.2);
        --shadow-hover: 0 35px 70px rgba(78, 115, 223, 0.3);
    }

    * {
        box-sizing: border-box;
    }

    body {
        background: 
            radial-gradient(circle at 30% 40%, rgba(78,115,223,0.4) 0%, transparent 50%),
            radial-gradient(circle at 70% 70%, rgba(34,74,190,0.3) 0%, transparent 50%),
            var(--admin-primary);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        overflow: hidden;
        position: relative;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='40' cy='40' r='3'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        animation: floatBg 25s ease-in-out infinite;
    }

    @keyframes floatBg {
        0%, 100% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-15px) scale(1.05); }
    }

    .floating-shapes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .admin-shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        backdrop-filter: blur(15px);
        animation: floatShape 18s ease-in-out infinite;
        box-shadow: 0 8px 32px rgba(255,255,255,0.1);
    }

    @keyframes floatShape {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        33% { transform: translateY(-25px) rotate(120deg) scale(1.1); }
        66% { transform: translateY(15px) rotate(240deg) scale(0.95); }
    }

    .admin-shape:nth-child(1) { width: 100px; height: 100px; top: 15%; left: 5%; animation-delay: 0s; }
    .admin-shape:nth-child(2) { width: 140px; height: 140px; top: 65%; right: 8%; animation-delay: 6s; }
    .admin-shape:nth-child(3) { width: 80px; height: 80px; bottom: 15%; left: 75%; animation-delay: 12s; }

    .admin-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        position: relative;
        z-index: 2;
    }

    .admin-card {
        width: 100%;
        max-width: 440px;
        background: var(--glass-bg);
        backdrop-filter: blur(40px);
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: var(--shadow-admin);
        animation: slideUpAdmin 1s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
    }

    @keyframes slideUpAdmin {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.9) rotateX(10deg);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1) rotateX(0deg);
        }
    }

    .admin-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-8px);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .admin-header {
        padding: 3rem 2.5rem 2rem;
        text-align: center;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
        position: relative;
        overflow: hidden;
    }

    .admin-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: 
            radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotateGlow 8s linear infinite;
    }

    @keyframes rotateGlow {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .admin-badge {
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
        backdrop-filter: blur(10px);
        color: rgba(255, 255, 255, 0.95);
        font-size: 0.8rem;
        font-weight: 700;
        padding: 8px 20px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(255,255,255,0.2);
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .admin-icon {
        width: 72px;
        height: 72px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        backdrop-filter: blur(15px);
        font-size: 2.2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: pulseIcon 2s ease-in-out infinite;
    }

    @keyframes pulseIcon {
        0%, 100% { transform: scale(1); box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        50% { transform: scale(1.05); box-shadow: 0 15px 40px rgba(78,115,223,0.3); }
    }

    .admin-title {
        font-size: clamp(1.6rem, 4vw, 2rem);
        font-weight: 800;
        background: linear-gradient(135deg, #fff 0%, #f0f4ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.75rem;
        letter-spacing: -0.02em;
    }

    .admin-subtitle {
        color: rgba(255, 255, 255, 0.85);
        font-size: 1rem;
        font-weight: 400;
        margin: 0;
    }

    .form-section {
        padding: 0 2.5rem 2.5rem;
    }

    .form-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 0.75rem;
        display: block;
    }

    .input-wrapper {
        position: relative;
        margin-bottom: 1.75rem;
    }

    .form-control {
        width: 100%;
        padding: 18px 22px 18px 55px;
        border: 2px solid rgba(255, 255, 255, 0.25);
        border-radius: 20px;
        background: var(--input-bg);
        backdrop-filter: blur(15px);
        font-size: 1rem;
        font-weight: 500;
        color: #1e293b;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .form-control:focus {
        border-color: rgba(255, 255, 255, 0.6);
        box-shadow: 0 12px 35px rgba(78,115,223,0.25);
        background: rgba(255, 255, 255, 1);
        transform: translateY(-3px);
        outline: none;
    }

    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.25rem;
        color: #94a3b8;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .form-control:focus + .input-icon,
    .form-control:not(:placeholder-shown) + .input-icon {
        color: #4e73df;
        transform: translateY(-50%) scale(1.1);
    }

    .toggle-password {
        right: 20px !important;
        left: auto !important;
        cursor: pointer;
        color: #94a3b8;
        transition: all 0.3s ease;
    }

    .toggle-password:hover {
        color: #4e73df;
        transform: scale(1.1);
    }

    .form-control::placeholder {
        color: #cbd5e1;
        font-weight: 400;
    }

    .btn-admin {
        width: 100%;
        padding: 18px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.95);
        color: #4e73df;
        font-size: 1.15rem;
        font-weight: 700;
        border: none;
        box-shadow: 0 15px 35px rgba(78,115,223,0.3);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-admin::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
        transition: left 0.7s;
    }

    .btn-admin:hover::before {
        left: 100%;
    }

    .btn-admin:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 25px 50px rgba(78,115,223,0.4);
        background: #fff;
        color: #2e59d9;
    }

    .btn-admin:active {
        transform: translateY(-2px) scale(1);
    }

    .error-message {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fee2e2;
        border-radius: 16px;
        padding: 14px 18px;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        backdrop-filter: blur(10px);
    }

    @media (max-width: 480px) {
        .admin-card {
            margin: 0 1rem;
            border-radius: 24px;
        }
        
        .admin-wrapper {
            padding: 1rem;
        }
    }
</style>

<div class="floating-shapes">
    <div class="admin-shape"></div>
    <div class="admin-shape"></div>
    <div class="admin-shape"></div>
</div>

<div class="admin-wrapper">
    <div class="admin-card">
        <div class="admin-header">
            <div class="admin-badge">
                <i class="bi bi-shield-lock"></i>
                ADMIN PANEL
            </div>
            <div class="admin-icon">🔐</div>
            <h4 class="admin-title">Admin Dashboard</h4>
            <p class="admin-subtitle">Masukkan kredensial admin untuk mengakses panel pengelolaan</p>
        </div>

        <div class="form-section">
            @if ($errors->any())
                <div class="error-message">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="post" action="{{ route('admin.login') }}">
                @csrf

                {{-- Username --}}
                <div class="input-wrapper">
                    <input 
                        type="text" 
                        class="form-control @error('username') is-invalid @enderror"
                        name="username"
                        placeholder="Username admin"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        required
                    >
                    <i class="bi bi-person-badge input-icon"></i>
                </div>

                @error('username')
                    <div class="invalid-feedback d-block text-start ms-1 mb-3">
                        <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}
                    </div>
                @enderror

                {{-- Password --}}
                <div class="input-wrapper">
                    <input 
                        type="password" 
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="Password admin"
                        autocomplete="current-password"
                        required
                    >
                    <i class="bi bi-key input-icon"></i>
                    <i class="bi bi-eye toggle-password input-icon" onclick="togglePassword()" id="toggle-icon"></i>
                </div>

                @error('password')
                    <div class="invalid-feedback d-block text-start ms-1">
                        <i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}
                    </div>
                @enderror

                <div class="d-grid">
                    <button type="submit" class="btn btn-admin">
                        <span class="me-2">⚡</span>
                        Masuk ke Dashboard
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('toggle-icon');

        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    // Enhanced password toggle with smooth transition
    document.addEventListener('DOMContentLoaded', function() {
        const toggleIcon = document.getElementById('toggle-icon');
        toggleIcon.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });
        toggleIcon.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
</script>
@endpush