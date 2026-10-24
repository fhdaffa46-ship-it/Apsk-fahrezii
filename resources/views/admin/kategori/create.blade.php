@extends('layouts.admin')
@section('title', 'Tambah Kategori')

@section('content')
<style>
    .form-container {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-card:hover {
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .form-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 2.5rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s;
    }

    .form-card:hover .form-header::before {
        left: 100%;
    }

    .form-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.02em;
    }

    .form-subtitle {
        opacity: 0.9;
        margin: 0.5rem 0 0 0;
        font-size: 1.1rem;
    }

    .form-body {
        padding: 3rem 2.5rem;
    }

    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.75rem;
        font-size: 1rem;
        display: block;
    }

    /* Custom Input Styling */
    .input-modern {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid rgba(0,0,0,0.08);
        border-radius: 16px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .input-modern:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1), 0 8px 25px rgba(16, 185, 129, 0.15);
        transform: translateY(-2px);
    }

    .input-modern::placeholder {
        color: #a1a1aa;
    }

    .btn-modern {
        padding: 14px 32px;
        border-radius: 16px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .btn-primary-modern {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        min-width: 140px;
        justify-content: center;
    }

    .btn-primary-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
    }

    .btn-secondary-modern {
        background: rgba(255, 255, 255, 0.8);
        color: #64748b;
        border: 2px solid rgba(100, 116, 139, 0.3);
        min-width: 140px;
        justify-content: center;
    }

    .btn-secondary-modern:hover {
        background: white;
        color: #1e293b;
        border-color: #10b981;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }

    .success-message {
        background: linear-gradient(135deg, rgba(16,185,129,0.1) 0%, rgba(5,150,105,0.1) 100%);
        border: 1px solid rgba(16,185,129,0.3);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 2rem;
        color: #166534;
    }

    @media (max-width: 768px) {
        .form-body {
            padding: 2rem 1.5rem;
        }
        
        .form-title {
            font-size: 1.75rem;
        }
        
        .btn-group {
            flex-direction: column;
        }
        
        .btn-modern {
            width: 100%;
        }
    }

    /* Loading Animation */
    .btn-loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .btn-loading::after {
        content: '';
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 10px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="form-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="form-card">
                    <!-- Header -->
                    <div class="form-header">
                        <h1 class="form-title">Tambah Kategori</h1>
                        <p class="form-subtitle">Buat kategori baru untuk pengaduan sarana Kampus</p>
                    </div>

                    <!-- Form Body -->
                    <div class="form-body">
                        @if (session('success'))
                            <div class="success-message">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.kategori.store') }}" 
                              method="POST" id="createForm">
                            @csrf

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-tag me-2"></i>Nama Kategori
                                </label>
                                <input type="text" 
                                       name="nama_kategori"
                                       class="input-modern @error('nama_kategori') is-invalid @enderror"
                                       value="{{ old('nama_kategori') }}"
                                       placeholder="Contoh: Ruang Kelas, Toilet, Laboratorium"
                                       required>
                                @error('nama_kategori')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="btn-group">
                                <button type="submit" class="btn-modern btn-primary-modern" id="submitBtn">
                                    <i class="bi bi-plus-circle"></i>
                                    Simpan Kategori
                                </button>
                                <a href="{{ route('admin.kategori.index') }}" 
                                   class="btn-modern btn-secondary-modern">
                                    <i class="bi bi-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('createForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.classList.add('btn-loading');
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';
});
</script>
@endsection