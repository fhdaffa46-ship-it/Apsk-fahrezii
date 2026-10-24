@extends('layouts.admin')
@section('title', 'Akun Saya')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-4">
        <div class="bg-primary rounded-circle p-3 me-3 shadow-sm">
            <i class="bi bi-person-circle text-white fs-3"></i>
        </div>
        <div>
            <h1 class="mb-1 fw-bold text-dark">Pengaturan Akun</h1>
            <p class="text-muted mb-0">Kelola profil dan keamanan akun Anda</p>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 text-success fs-5"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- PROFIL CARD --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-gradient-primary text-white border-0 pt-4 pb-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                            <i class="bi bi-person fs-4"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold">Profil Admin</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.akun') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input 
                                type="text" 
                                name="nama" 
                                label="Nama Lengkap" 
                                value="{{ $admin->nama }}"
                                class="form-control-lg shadow-sm border-primary-subtle"
                                inputClass="form-control-lg"
                            />
                        </div>
                        <div class="mb-4">
                            <x-input 
                                type="text" 
                                name="username" 
                                label="Username" 
                                placeholder="Masukkan username baru"
                                value="{{ $admin->username }}"
                                class="form-control-lg shadow-sm border-primary-subtle"
                                inputClass="form-control-lg"
                            />
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                            <i class="bi bi-check-lg me-2"></i>
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- PASSWORD CARD --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100">
                <div class="card-header bg-gradient-warning text-dark border-0 pt-4 pb-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                            <i class="bi bi-shield-lock fs-4"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold">Keamanan Password</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.akun.password') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input 
                                type="password" 
                                name="password_lama"
                                label="Password Saat Ini"
                                placeholder="Masukkan password lama"
                                class="form-control-lg shadow-sm"
                                inputClass="form-control-lg"
                            />
                        </div>
                        <div class="mb-4">
                            <x-input 
                                type="password" 
                                name="password_baru"
                                label="Password Baru"
                                placeholder="Buat password baru (min 8 karakter)"
                                class="form-control-lg shadow-sm"
                                inputClass="form-control-lg"
                            />
                        </div>
                        <div class="mb-4">
                            <x-input 
                                type="password" 
                                name="password_baru_confirmation"
                                label="Konfirmasi Password Baru"
                                placeholder="Ulangi password baru"
                                class="form-control-lg shadow-sm"
                                inputClass="form-control-lg"
                            />
                        </div>
                        <button type="submit" class="btn btn-warning btn-lg w-100 shadow-sm text-dark fw-semibold">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.card {
    border-radius: 20px !important;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.btn {
    border-radius: 12px;
    padding: 12px 24px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.form-control, .form-control-lg {
    border-radius: 12px;
    border: 2px solid #e9ecef;
    padding: 14px 20px;
    transition: all 0.3s ease;
    background: rgba(255,255,255,0.95);
}

.form-control:focus, .form-control-lg:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    background: rgba(255,255,255,1);
}
</style>
@endsection