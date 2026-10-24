@extends('layouts.admin')
@section('title', 'Tambah Data Siswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-md-block">
            <ol class="breadcrumb breadcrumb-light mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.siswa-data.index') }}">Data Mahasiswa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Mahasiswa</li>
            </ol>
        </nav>
        <h4 class="mb-1 text-dark fw-bold">Tambah Data Mahasiswa</h4>
        <p class="text-muted mb-0">Isi data Mahasiswa dengan lengkap dan akurat</p>
    </div>
    <a href="{{ route('admin.siswa-data.index') }}" class="btn btn-outline-secondary px-4">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-6">
        <div class="card border-0 shadow-xl">
            <div class="card-header bg-gradient-primary text-white border-0 py-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-1 fw-bold">
                            <i class="bi bi-person-plus-fill me-2"></i>
                            Data Mahasiswa Baru
                        </h5>
                        <small>Formulir wajib diisi lengkap</small>
                    </div>
                    <div class="col-auto">
                        <div class="avatar-placeholder rounded-circle bg-white bg-opacity-20 p-3">
                            <i class="bi bi-person-fill fs-1 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-5">
                <form action="{{ route('admin.siswa-data.store') }}" method="POST" enctype="multipart/form-data" id="siswaForm">
                    @csrf
                    
                    {{-- NIS --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark mb-2">
                            <i class="bi bi-hash me-2 text-primary"></i>
                            NIM
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-modern">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="bi bi-card-text text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="nis" 
                                   class="form-control form-control-modern @error('nis') is-invalid @enderror ps-0 border-start-0"
                                   value="{{ old('nis') }}" 
                                   placeholder="Contoh: 12345678"
                                   maxlength="20"
                                   required>
                        </div>
                        @error('nis')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark mb-2">
                            <i class="bi bi-person-circle me-2 text-primary"></i>
                            Nama Lengkap
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-modern">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="bi bi-person text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="nama" 
                                   class="form-control form-control-modern @error('nama') is-invalid @enderror ps-0 border-start-0"
                                   value="{{ old('nama') }}" 
                                   placeholder="Nama lengkap siswa"
                                   required>
                        </div>
                        @error('nama')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kelas --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark mb-2">
                            <i class="bi bi-mortarboard-fill me-2 text-primary"></i>
                            Kelas
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-modern">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="bi bi-book text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="kelas" 
                                   class="form-control form-control-modern @error('kelas') is-invalid @enderror ps-0 border-start-0"
                                   value="{{ old('kelas') }}" 
                                   placeholder="Contoh: X IPA 1"
                                   required>
                        </div>
                        @error('kelas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Foto Profil --}}
                    <div class="mb-5">
                        <label class="form-label fw-semibold text-dark mb-3 d-block">
                            <i class="bi bi-image me-2 text-primary"></i>
                            Foto Profil
                        </label>
                        <div class="file-upload-modern">
                            <input type="file" 
                                   name="foto_profil" 
                                   class="form-control form-control-modern @error('foto_profil') is-invalid @enderror file-input"
                                   id="fotoInput"
                                   accept="image/*"
                                   data-max-size="5242880">
                            <label for="fotoInput" class="file-upload-label">
                                <i class="bi bi-cloud-upload fs-1 text-muted mb-3"></i>
                                <h6 class="mb-2 fw-semibold text-muted">Klik untuk upload foto</h6>
                                <p class="text-muted mb-0">Format JPG, PNG, WebP (Max 5MB)</p>
                                <div class="file-preview mt-3 d-none">
                                    <img id="previewImg" class="img-thumbnail rounded-circle shadow-sm" alt="Preview">
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2 remove-image">
                                        <i class="bi bi-x"></i> Hapus
                                    </button>
                                </div>
                            </label>
                        </div>
                        @error('foto_profil')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-3 justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('admin.siswa-data.index') }}" class="btn btn-outline-secondary px-4 shadow-sm">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow-lg submit-btn">
                            <span class="submit-text">
                                <i class="bi bi-check-circle me-2"></i>Simpan Data
                            </span>
                            <span class="submit-loading d-none">
                                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.shadow-xl {
    box-shadow: 0 25px 50px rgba(0,0,0,0.12) !important;
}

.input-group-modern .input-group-text {
    border-radius: 12px 0 0 12px;
    border-right: none;
}

.input-group-modern .form-control {
    border-radius: 0 12px 12px 0;
    border-left: none;
    padding-left: 1rem;
}

.form-control-modern {
    border: 2px solid #e9ecef;
    padding: 0.875rem 1.25rem;
    font-size: 0.95rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: #fafbfc;
}

.form-control-modern:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    background: #fff;
    transform: translateY(-1px);
}

.file-upload-modern {
    position: relative;
    border: 2px dashed #dee2e6;
    border-radius: 16px;
    padding: 3rem 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-upload-modern:hover {
    border-color: #0d6efd;
    background: linear-gradient(135deg, #f0f8ff 0%, #e3f2fd 100%);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(13, 110, 253, 0.15);
}

.file-upload-label {
    display: block;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-preview img {
    width: 100px;
    height: 100px;
    object-fit: cover;
}

.avatar-placeholder {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.breadcrumb-light .breadcrumb-item a {
    color: rgba(255,255,255,0.9);
    text-decoration: none;
}

.breadcrumb-light .breadcrumb-item a:hover {
    color: white;
}

.btn-lg {
    padding: 0.75rem 2rem;
    font-weight: 600;
    border-radius: 12px;
}

.submit-btn {
    position: relative;
    overflow: hidden;
}

.submit-btn:not(:disabled):not(.disabled):active,
.submit-btn:focus {
    transform: translateY(-1px);
    box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
}

.card-body {
    border-radius: 0 0 24px 24px;
}

@media (max-width: 768px) {
    .card-body {
        padding: 2rem 1.5rem !important;
    }
    
    .file-upload-modern {
        padding: 2rem 1rem !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('siswaForm');
    const submitBtn = document.querySelector('.submit-btn');
    const fotoInput = document.getElementById('fotoInput');
    const fileLabel = document.querySelector('.file-upload-label');
    const previewContainer = document.querySelector('.file-preview');
    const previewImg = document.getElementById('previewImg');
    const removeBtn = document.querySelector('.remove-image');

    // File preview
    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check file size (5MB)
            if (file.size > 5242880) {
                alert('Ukuran file maksimal 5MB!');
                this.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('d-none');
                fileLabel.querySelector('h6').textContent = 'Foto terpilih: ' + file.name;
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove image
    removeBtn.addEventListener('click', function() {
        fotoInput.value = '';
        previewContainer.classList.add('d-none');
        fileLabel.querySelector('h6').textContent = 'Klik untuk upload foto';
    });

    // Form submission with loading
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.querySelector('.submit-text').classList.add('d-none');
        submitBtn.querySelector('.submit-loading').classList.remove('d-none');
    });

    // Input focus animations
    document.querySelectorAll('.form-control-modern').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.parentElement.classList.remove('focused');
        });
    });

    // Auto-format NIS (only numbers)
    const nisInput = document.querySelector('input[name="nis"]');
    nisInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>
@endsection