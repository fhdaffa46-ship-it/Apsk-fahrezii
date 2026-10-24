@extends('layouts.siswa')

@section('title', 'Akun Saya')

@section('content')
<style>
.profile-card-clean {
    border-radius: 20px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
}

.profile-header-clean {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    height: 120px;
    border-radius: 20px 20px 0 0;
}

.profile-avatar-clean {
    width: 100px;
    height: 100px;
    border: 4px solid white;
    border-radius: 16px;
    margin-top: -50px;
    transition: all 0.3s ease;
}

.profile-avatar-clean:hover {
    transform: scale(1.05);
}

.profile-name-clean {
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.profile-class-clean {
    color: #64748b;
    font-weight: 600;
    background: #f1f5f9;
    padding: 0.5rem 1.25rem;
    border-radius: 25px;
    font-size: 0.95rem;
    display: inline-block;
}

.form-control-clean {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 0.875rem 1.25rem;
    transition: all 0.25s ease;
}

.form-control-clean:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.2rem rgba(59,130,246,0.1);
}

.btn-save-clean {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    border-radius: 12px;
    padding: 0.875rem 2rem;
    font-weight: 600;
    border: none;
    transition: all 0.25s ease;
}

.btn-save-clean:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59,130,246,0.3);
}

.file-upload-clean {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 2rem 1rem;
    text-align: center;
    transition: all 0.25s ease;
    background: #fafbfc;
}

.file-upload-clean:hover {
    border-color: #3b82f6;
    background: #eff6ff;
}
</style>

<div class="row justify-content-center">
    <div class="col-lg-6 col-xl-5">
        
        {{-- Profile Card --}}
        <div class="card profile-card-clean shadow-lg mt-4 mb-5">
            
            {{-- Header --}}
            <div class="profile-header-clean"></div>
            
            <div class="card-body p-4 text-center position-relative">
                
                {{-- Avatar --}}
                <div class="profile-avatar-clean mx-auto mb-3 shadow-lg" onclick="document.getElementById('fotoInput').click()">
                    <img src="{{ $siswa->foto_profil ? asset('storage/' . $siswa->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($siswa->nama) . '&background=3b82f6&color=fff&size=128' }}"
                         class="w-100 h-100 rounded-3 object-fit-cover"
                         alt="Foto Profil">
                </div>

                {{-- Info --}}
                <h4 class="profile-name-clean mb-2">{{ $siswa->nama }}</h4>
                <div class="profile-class-clean mb-4">
                    {{ $siswa->kelas }}
                </div>

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('siswa.akun.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Foto Upload --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small mb-2 d-block text-center">
                            Ganti Foto Profil
                        </label>
                        <div class="file-upload-clean mb-3" onclick="document.getElementById('fotoInput').click()">
                            <i class="bi bi-camera-fill fs-2 text-muted mb-2 d-block"></i>
                            <small class="text-muted">Klik untuk upload foto baru</small>
                            <input type="file" 
                                   name="foto_profil" 
                                   id="fotoInput"
                                   class="d-none"
                                   accept="image/*">
                        </div>
                        @error('foto_profil')
                            <div class="text-danger small text-center">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Form Fields --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">NIS</label>
                            <x-input name="nis" :value="$siswa->nis" class="form-control-clean" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">Kelas</label>
                            <x-input name="kelas" :value="$siswa->kelas" class="form-control-clean" />
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-muted small">Nama Lengkap</label>
                            <x-input name="nama" :value="$siswa->nama" class="form-control-clean" />
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-save-clean text-white">
                            <i class="bi bi-check2-circle me-2"></i>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('siswa.dashboard') }}" class="btn btn-outline-secondary rounded-2xl">
                            <i class="bi bi-arrow-left me-2"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('fotoInput').addEventListener('change', function() {
    if (this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const avatar = document.querySelector('.profile-avatar-clean img');
            avatar.src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
@endsection