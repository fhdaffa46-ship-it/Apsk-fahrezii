@extends('layouts.admin')
@section('title', 'Edit Data Siswa')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap');

    :root {
        --ink: #15213a;
        --paper: #faf7f1;
        --paper-dim: #efe9dd;
        --orange: #e8622c;
        --orange-soft: #fdece3;
        --slate: #5b6b7c;
        --slate-light: #93a1b0;
        --border: #e7e2d6;
        --danger: #c0392b;
        --green: #2f8f5b;
        --green-soft: #eaf6ee;
    }

    .admin-form-modern {
        background: #fff;
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: 0 20px 50px rgba(21,33,58,0.08);
        overflow: hidden;
        font-family: 'Inter', sans-serif;
    }

    .admin-header-modern {
        background: var(--ink);
        padding: 1.8rem 2.2rem;
        position: relative;
    }

    .profile-preview-modern {
        display: flex;
        align-items: center;
        gap: 1.2rem;
    }

    .avatar-modern-admin {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        border: 2px solid rgba(255,255,255,0.25);
        object-fit: cover;
    }

    .profile-info-modern-admin h5 {
        margin: 0 0 0.15rem;
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.2rem;
        color: #fff;
    }

    .profile-info-modern-admin small {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.78rem;
        color: var(--orange-soft);
        letter-spacing: 0.03em;
    }

    .form-section-modern-admin {
        padding: 2.2rem;
    }

    .form-group-modern-admin {
        margin-bottom: 1.6rem;
    }

    .label-modern-admin {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 500;
        color: var(--slate);
        margin-bottom: 0.55rem;
        font-size: 0.72rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .label-modern-admin i { color: var(--orange); font-size: 0.9rem; }

    .input-modern-admin {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 0.8rem 1.1rem;
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--ink);
        background: #fff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .input-modern-admin:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(232,98,44,0.15);
        outline: none;
    }

    .input-modern-admin.is-invalid {
        border-color: var(--danger);
    }

    .file-upload-modern-admin {
        border: 1.5px dashed var(--border);
        border-radius: 12px;
        padding: 1.8rem 1.5rem;
        text-align: center;
        transition: border-color 0.2s ease, background 0.2s ease;
        background: var(--paper);
        cursor: pointer;
        display: block;
    }

    .file-upload-modern-admin:hover {
        border-color: var(--orange);
        background: var(--orange-soft);
    }

    .file-icon-modern {
        font-size: 1.8rem;
        color: var(--slate-light);
        margin-bottom: 0.5rem;
        display: block;
    }

    .file-upload-modern-admin h6 {
        font-size: 0.92rem;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 0.2rem;
    }

    .file-upload-modern-admin p {
        font-size: 0.82rem;
        color: var(--slate);
        margin: 0;
    }

    .btn-group-modern-admin {
        padding-top: 1.4rem;
        border-top: 1px solid var(--paper-dim);
        margin-top: 1.6rem;
    }

    .btn-primary-modern-admin {
        background: var(--orange);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.8rem;
        font-weight: 600;
        font-size: 0.95rem;
        color: #fff;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .btn-primary-modern-admin:hover {
        background: #d1531e;
        transform: translateY(-1px);
        color: #fff;
    }

    .btn-secondary-modern-admin {
        border-radius: 10px;
        padding: 0.75rem 1.6rem;
        font-weight: 600;
        font-size: 0.95rem;
        border: 1.5px solid var(--border);
        color: var(--slate);
        transition: border-color 0.2s ease, color 0.2s ease;
    }

    .btn-secondary-modern-admin:hover {
        border-color: var(--slate-light);
        color: var(--ink);
    }

    .alert-modern-admin {
        border-radius: 12px;
        border: 1px solid #bfe3cc;
        background: var(--green-soft);
        color: #24693f;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .form-section-modern-admin {
            padding: 1.6rem 1.4rem;
        }
    }
</style>

<div class="admin-form-modern mt-4 mb-5 mx-auto" style="max-width: 860px;">

    {{-- HEADER --}}
    <div class="admin-header-modern">
        <div class="profile-preview-modern">
            <img src="{{ $siswa->foto_profil ? asset('storage/' . $siswa->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($siswa->nama) . '&background=e8622c&color=fff&size=60' }}"
                 class="avatar-modern-admin"
                 alt="Foto {{ $siswa->nama }}">
            <div class="profile-info-modern-admin">
                <h5>{{ $siswa->nama }}</h5>
                <small>NIS {{ $siswa->nis }}</small>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="form-section-modern-admin">

        @if (session('success'))
            <div class="alert alert-modern-admin mb-4 p-3" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                    <div>
                        <h6 class="mb-1 fw-semibold">Berhasil diperbarui</h6>
                        <div>{{ session('success') }}</div>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.siswa-data.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- NIS --}}
                <div class="col-lg-6">
                    <div class="form-group-modern-admin">
                        <label class="label-modern-admin"><i class="bi bi-hash"></i>Nomor Induk Mahasiswa</label>
                        <input type="text"
                               name="nis"
                               class="input-modern-admin @error('nis') is-invalid @enderror"
                               value="{{ old('nis', $siswa->nis) }}"
                               placeholder="Contoh: 2425108"
                               required>
                        @error('nis')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kelas --}}
                <div class="col-lg-6">
                    <div class="form-group-modern-admin">
                        <label class="label-modern-admin"><i class="bi bi-mortarboard"></i>Jurusan</label>
                        <input type="text"
                               name="kelas"
                               class="input-modern-admin @error('kelas') is-invalid @enderror"
                               value="{{ old('kelas', $siswa->kelas) }}"
                               placeholder="Contoh: X PPLG 1"
                               required>
                        @error('kelas')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Nama --}}
                <div class="col-12">
                    <div class="form-group-modern-admin">
                        <label class="label-modern-admin"><i class="bi bi-person"></i>Nama Lengkap</label>
                        <input type="text"
                               name="nama"
                               class="input-modern-admin @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $siswa->nama) }}"
                               placeholder="Nama lengkap siswa"
                               required>
                        @error('nama')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Foto --}}
                <div class="col-12">
                    <div class="form-group-modern-admin mb-0">
                        <label class="label-modern-admin"><i class="bi bi-image"></i>Foto Profil</label>
                        <label for="foto_profil" class="file-upload-modern-admin">
                            <i class="bi bi-cloud-upload file-icon-modern"></i>
                            <h6>Ganti foto profil</h6>
                            <p>JPG atau PNG, maksimal 2MB. Biarkan kosong jika tidak diubah.</p>
                            <input type="file"
                                   name="foto_profil"
                                   id="foto_profil"
                                   class="d-none @error('foto_profil') is-invalid @enderror"
                                   accept="image/*">
                        </label>
                        @error('foto_profil')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            {{-- Buttons --}}
            <div class="btn-group-modern-admin">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.siswa-data.index') }}" class="btn-secondary-modern-admin">
                        <i class="bi bi-arrow-left me-1"></i>Batal
                    </a>
                    <button type="submit" class="btn-primary-modern-admin">
                        <i class="bi bi-check2 me-1"></i>Update MahaSiswa
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection