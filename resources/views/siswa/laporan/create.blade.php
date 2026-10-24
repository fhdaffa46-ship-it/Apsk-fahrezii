@extends('layouts.siswa')

@section('title', 'Buat Laporan Pengaduan')

@section('content')
<style>
/* Modern Report Form */
.report-form-modern {
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.25);
    background: #ffffff;
    max-width: 800px;
    margin: 0 auto;
}

.report-header-modern {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #1e40af 100%);
    color: white;
    padding: 2.5rem 2.5rem 2rem;
    position: relative;
    overflow: hidden;
}

.report-header-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #10b981, #f59e0b, #ef4444);
}

.report-title-modern {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    position: relative;
    z-index: 2;
}

.report-subtitle-modern {
    opacity: 0.95;
    font-size: 1rem;
    margin: 0;
    position: relative;
    z-index: 2;
}

.form-section-modern {
    padding: 2.5rem;
}

.form-group-modern {
    margin-bottom: 1.75rem;
}

.form-label-modern {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-control-modern,
.form-select-modern {
    border: 2px solid #e5e7eb;
    border-radius: 14px;
    padding: 1rem 1.25rem;
    font-size: 0.95rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: #fafbfc;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.form-control-modern:focus,
.form-select-modern:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.25rem rgba(59,130,246,0.15);
    background: #ffffff;
    transform: translateY(-1px);
}

.textarea-modern {
    resize: vertical;
    min-height: 120px;
}

.file-upload-modern {
    position: relative;
    border: 2px dashed #d1d5db;
    border-radius: 16px;
    padding: 2.5rem 1.5rem;
    background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    transition: all 0.3s ease;
    cursor: pointer;
    text-align: center;
}

.file-upload-modern:hover {
    border-color: #3b82f6;
    background: #eff6ff;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(59,130,246,0.15);
}

.file-upload-modern.dragover {
    border-color: #3b82f6;
    background: #dbeafe;
}

.file-preview-modern {
    display: none;
    margin-top: 1rem;
    padding: 1rem;
    background: #f0f9ff;
    border-radius: 12px;
    border: 2px solid #bae6fd;
}

.file-preview-modern.show {
    display: block;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.btn-submit-modern {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border: none;
    border-radius: 16px;
    padding: 1rem 2.5rem;
    font-weight: 600;
    font-size: 1rem;
    color: white;
    box-shadow: 0 8px 25px rgba(59,130,246,0.3);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.btn-submit-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(59,130,246,0.4);
}

.btn-submit-modern:active {
    transform: translateY(-1px);
}

.btn-back-modern {
    border-radius: 16px;
    padding: 1rem 2rem;
    font-weight: 500;
    border: 2px solid #e5e7eb;
    color: #374151;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-back-modern:hover {
    background: #f3f4f6;
    border-color: #d1d5db;
    transform: translateY(-2px);
    color: #1f2937;
}

.alert-modern {
    border-radius: 12px;
    border: none;
    font-weight: 500;
}

.progress-bar-modern {
    height: 4px;
    border-radius: 10px;
    background: rgba(59,130,246,0.2);
}

@media (max-width: 768px) {
    .report-form-modern {
        margin: 0 1rem;
        border-radius: 20px;
    }
    
    .form-section-modern {
        padding: 2rem 1.5rem;
    }
    
    .report-header-modern {
        padding: 2rem 1.5rem 1.5rem;
    }
}
</style>

<div class="report-form-modern mt-5 mb-5">
    {{-- HEADER --}}
    <div class="report-header-modern position-relative">
        <div class="position-relative z-2">
            <h1 class="report-title-modern mb-2">
                <i class="bi bi-megaphone-fill me-3"></i>
                Buat Laporan Pengaduan
            </h1>
            <p class="report-subtitle-modern mb-0">
                Laporkan kerusakan atau masalah sarana sekolah dengan mudah
            </p>
        </div>
    </div>

    {{-- FORM --}}
    <div class="form-section-modern">
        @if (session('success'))
            <div class="alert alert-success alert-modern shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('siswa.laporan.store') }}" method="POST" enctype="multipart/form-data" id="reportForm">
            @csrf

            {{-- Progress Bar --}}
            <div class="mb-4">
                <div class="progress progress-bar-modern">
                    <div class="progress-bar bg-primary" style="width: 40%"></div>
                </div>
                <small class="text-muted">Langkah 1 dari 3</small>
            </div>

            {{-- Kategori --}}
            <div class="form-group-modern">
                <label class="form-label-modern">
                    <i class="bi bi-tag-fill text-primary"></i>
                    Kategori
                </label>
                <x-select name="kategori_id"
                          :options="$kategori"
                          label-field="nama_kategori"
                          class="form-control-modern form-select-modern" />
                @error('kategori_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div class="form-group-modern">
                <label class="form-label-modern">
                    <i class="bi bi-geo-alt-fill text-primary"></i>
                    Lokasi Kejadian
                </label>
                <x-select name="lokasi_id"
                          :options="$lokasi"
                          label-field="nama_lokasi"
                          class="form-control-modern form-select-modern" />
                @error('lokasi_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Sarana --}}
            <div class="form-group-modern">
                <label class="form-label-modern">
                    <i class="bi bi-building-fill text-primary"></i>
                    Sarana
                </label>
                <x-select name="sarana_id"
                          :options="$sarana"
                          label-field="nama_sarana"
                          class="form-control-modern form-select-modern" />
                @error('sarana_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="form-group-modern">
                <label class="form-label-modern">
                    <i class="bi bi-chat-text-fill text-primary"></i>
                    Keterangan Lengkap
                </label>
                <x-textarea name="ket"
                            placeholder="Jelaskan kejadian secara detail, termasuk kapan terjadi, kondisi saat ini, dan dampak yang ditimbulkan..."
                            rows="6"
                            class="form-control-modern textarea-modern" />
                @error('ket')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Gambar Bukti --}}
            <div class="form-group-modern">
                <label class="form-label-modern">
                    <i class="bi bi-image-fill text-primary"></i>
                    Gambar Bukti <span class="text-danger">*</span>
                </label>
                <div class="file-upload-modern" id="fileUploadArea">
                    <input type="file"
                           name="gambar"
                           id="gambarInput"
                           class="d-none @error('gambar') is-invalid @enderror"
                           accept="image/*"
                           required>
                    <label for="gambarInput" class="cursor-pointer w-100">
                        <i class="bi bi-cloud-upload fs-1 text-muted mb-3 d-block"></i>
                        <h6 class="mb-2 fw-semibold text-muted">Klik atau drag & drop gambar</h6>
                        <p class="text-muted mb-0 small">JPG, PNG, WebP • Maksimal 3MB</p>
                        <div class="file-preview-modern" id="filePreview">
                            <img id="previewImg" class="img-thumbnail rounded-3 shadow-sm me-3 mb-2" style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <div id="fileName" class="fw-semibold small mb-1"></div>
                                <div class="text-success small mb-2">✅ Siap diupload</div>
                                <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 remove-file">
                                    <i class="bi bi-x"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </label>
                </div>
                @error('gambar')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex gap-3 justify-content-between align-items-center pt-3 mt-4 border-top">
                <a href="{{ route('siswa.dashboard') }}" class="btn btn-back-modern">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-submit-modern" id="submitBtn">
                    <span class="submit-text">
                        <i class="bi bi-send-fill me-2"></i>Kirim Laporan
                    </span>
                    <span class="submit-loading d-none">
                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                        Mengirim...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('gambarInput');
    const filePreview = document.getElementById('filePreview');
    const previewImg = document.getElementById('previewImg');
    const fileName = document.getElementById('fileName');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('reportForm');

    // File upload functionality
    fileInput.addEventListener('change', handleFile);
    
    fileUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileUploadArea.classList.add('dragover');
    });
    
    fileUploadArea.addEventListener('dragleave', () => {
        fileUploadArea.classList.remove('dragover');
    });
    
    fileUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileUploadArea.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFile();
        }
    });

    function handleFile() {
        const file = fileInput.files[0];
        if (file) {
            // Validate file size (3MB)
            if (file.size > 3 * 1024 * 1024) {
                alert('Ukuran file maksimal 3MB!');
                fileInput.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                fileName.textContent = file.name;
                filePreview.classList.add('show');
            };
            reader.readAsDataURL(file);
        }
    }

    // Remove file
    document.addEventListener('click', (e) => {
        if (e.target.closest('.remove-file')) {
            fileInput.value = '';
            filePreview.classList.remove('show');
        }
    });

    // Form submission
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.querySelector('.submit-text').classList.add('d-none');
        submitBtn.querySelector('.submit-loading').classList.remove('d-none');
    });

    // Auto-resize textarea
    document.querySelectorAll('.textarea-modern').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
});
</script>
@endsection