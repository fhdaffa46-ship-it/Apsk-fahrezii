@extends('layouts.admin')
@section('title', 'Data Siswa')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap');

    :root {
        --ink: #15213a;
        --paper-dim: #efe9dd;
        --orange: #e8622c;
        --orange-soft: #fdece3;
        --slate: #5b6b7c;
        --slate-light: #93a1b0;
        --border: #e7e2d6;
        --danger: #c0392b;
    }

    .siswa-page-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin: 1.2rem 0 1.4rem;
    }

    .siswa-page-title {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--ink);
        margin: 0 0 0.2rem;
    }

    .siswa-page-sub {
        font-family: 'Inter', sans-serif;
        color: var(--slate);
        font-size: 0.9rem;
        margin: 0;
    }

    .siswa-alert {
        background: #eaf6ee;
        border: 1px solid #bfe3cc;
        color: #24693f;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 0.9rem;
        margin-bottom: 1.2rem;
    }

    .siswa-card {
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: none;
        overflow: hidden;
    }

    .siswa-card .card-body {
        padding: 1.4rem 1.4rem 0.6rem;
    }

    .btn-add {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        background: var(--orange);
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 10px 18px;
        transition: background 0.2s ease;
    }

    .btn-add:hover {
        background: #d1531e;
        color: #fff;
    }

    .siswa-table {
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
    }

    .siswa-table thead th {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--slate);
        border-bottom: 1.5px solid var(--border);
        padding-bottom: 0.8rem;
        white-space: nowrap;
    }

    .siswa-table tbody td {
        vertical-align: middle;
        color: var(--ink);
        border-bottom: 1px solid var(--paper-dim);
        padding-top: 0.7rem;
        padding-bottom: 0.7rem;
    }

    .siswa-table tbody tr:hover {
        background: #faf8f3;
    }

    .siswa-no {
        font-family: 'JetBrains Mono', monospace;
        color: var(--slate-light);
        font-size: 0.85rem;
    }

    .siswa-avatar {
        width: 38px;
        height: 38px;
        object-fit: cover;
        border-radius: 50%;
        border: 1.5px solid var(--border);
    }

    .siswa-nama {
        font-weight: 600;
        color: var(--ink);
    }

    .siswa-nis {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.85rem;
        color: var(--slate);
    }

    .siswa-kelas-badge {
        display: inline-block;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--orange);
        background: var(--orange-soft);
        padding: 4px 10px;
        border-radius: 20px;
    }

    .btn-edit {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--ink);
        background: #fff;
        border: 1.5px solid var(--border);
        border-radius: 6px;
        padding: 5px 12px;
        transition: border-color 0.2s ease, color 0.2s ease;
    }

    .btn-edit:hover {
        border-color: var(--orange);
        color: var(--orange);
    }

    .btn-hapus {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--danger);
        background: #fff;
        border: 1.5px solid #f0c4bd;
        border-radius: 6px;
        padding: 5px 12px;
        transition: background 0.2s ease;
    }

    .btn-hapus:hover {
        background: #fbeae8;
        color: var(--danger);
    }

    .siswa-empty {
        padding: 3rem 1rem;
        text-align: center;
        color: var(--slate-light);
    }

    .siswa-empty i {
        font-size: 2rem;
        display: block;
        margin-bottom: 0.6rem;
        color: var(--border);
    }

    .card-footer {
        background: #fff;
        border-top: 1px solid var(--paper-dim);
    }
</style>

<div class="siswa-page-head">
    <div>
        <h4 class="siswa-page-title">Data Siswa</h4>
        <p class="siswa-page-sub">Daftar siswa terdaftar yang dapat mengajukan laporan kerusakan fasilitas.</p>
    </div>
    <a href="{{ route('admin.siswa-data.create') }}" class="btn-add">+ Tambah Siswa</a>
</div>

@if (session('success'))
    <div class="siswa-alert">{{ session('success') }}</div>
@endif

<div class="card siswa-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table siswa-table mb-0">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="60">Foto</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Kelas</th>
                        <th width="170">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $siswa)
                        <tr>
                            <td class="siswa-no">{{ $loop->iteration + ($siswas->firstItem() - 1) }}</td>
                            <td>
                                <img src="{{ $siswa->foto_profil ? asset('storage/' . $siswa->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($siswa->nama) . '&background=e8622c&color=fff' }}"
                                    alt="Foto {{ $siswa->nama }}"
                                    class="siswa-avatar">
                            </td>
                            <td class="siswa-nama">{{ $siswa->nama }}</td>
                            <td class="siswa-nis">{{ $siswa->nis }}</td>
                            <td><span class="siswa-kelas-badge">{{ $siswa->kelas }}</span></td>
                            <td>
                                <a href="{{ route('admin.siswa-data.edit', $siswa->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('admin.siswa-data.destroy', $siswa->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus" onclick="return confirm('Hapus data siswa ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-0">
                                <div class="siswa-empty">
                                    <i class="bi bi-people"></i>
                                    Belum ada data Mahasiswa. Klik "Tambah MahaSiswa" untuk menambahkan.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer pb-0">{{ $siswas->links() }}</div>
</div>
@endsection