@extends('layouts.admin')

@section('title', 'Daftar Laporan dan Aspirasi')

@section('content')

<style>
    .stat-card {
        border: none;
        border-radius: 14px;
        transition: 0.2s;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(13,110,253,0.12);
    }

    .stat-title {
        font-size: 12px;
        color: #6c757d;
    }

    .stat-value {
        font-size: 22px;
        font-weight: 700;
        color: #0d6efd;
    }

    .section-title {
        font-weight: 600;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .btn-export {
        border-radius: 8px;
    }
</style>

<div class="container-fluid mt-3">

    <h5 class="section-title">📋 Daftar Laporan dan Aspirasi</h5>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- REKAP --}}
    <div class="row g-3 mb-3">

        <div class="col-md-4">
            <div class="card shadow-sm stat-card">
                <div class="card-body">
                    <div class="stat-title">Rekap Harian</div>
                    <div class="stat-value">{{ $rekapLaporan['harian'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm stat-card">
                <div class="card-body">
                    <div class="stat-title">Rekap Mingguan</div>
                    <div class="stat-value">{{ $rekapLaporan['mingguan'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm stat-card">
                <div class="card-body">
                    <div class="stat-title">Rekap Bulanan</div>
                    <div class="stat-value">{{ $rekapLaporan['bulanan'] ?? 0 }}</div>
                </div>
            </div>
        </div>

    </div>

    {{-- FILTER + EXPORT --}}
    <div class="card shadow-sm mb-3">

        <div class="card-body">

            <form method="GET" action="{{ route('admin.laporan.index') }}">

                <div class="row g-2 align-items-end">

                    <div class="col-md-3">
                        <label class="form-label small">Status</label>
                        <select name="status" class="form-select form-select-sm"
                                onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="belum" {{ request('status')=='belum'?'selected':'' }}>Belum</option>
                            <option value="proses" {{ request('status')=='proses'?'selected':'' }}>Proses</option>
                            <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small">Kategori</label>
                        <select name="kategori_id" class="form-select form-select-sm"
                                onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach ($kategoriList as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ request('kategori_id')==$kategori->id?'selected':'' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small">Periode</label>
                        <select name="periode" class="form-select form-select-sm"
                                onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="harian" {{ request('periode')=='harian'?'selected':'' }}>Harian</option>
                            <option value="mingguan" {{ request('periode')=='mingguan'?'selected':'' }}>Mingguan</option>
                            <option value="bulanan" {{ request('periode')=='bulanan'?'selected':'' }}>Bulanan</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('admin.laporan.index') }}"
                           class="btn btn-secondary btn-sm w-100">
                            Reset
                        </a>
                    </div>

                </div>

            </form>

            {{-- EXPORT --}}
            <div class="d-flex flex-wrap gap-2 mt-3">

                <a href="{{ route('admin.laporan.export.pdf', array_merge(request()->only('status','kategori_id'), ['periode'=>'harian'])) }}"
                   class="btn btn-outline-primary btn-sm btn-export">
                    PDF Harian
                </a>

                <a href="{{ route('admin.laporan.export.pdf', array_merge(request()->only('status','kategori_id'), ['periode'=>'mingguan'])) }}"
                   class="btn btn-outline-primary btn-sm btn-export">
                    PDF Mingguan
                </a>

                <a href="{{ route('admin.laporan.export.pdf', array_merge(request()->only('status','kategori_id'), ['periode'=>'bulanan'])) }}"
                   class="btn btn-outline-primary btn-sm btn-export">
                    PDF Bulanan
                </a>

            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm">

        <div class="card-body table-responsive p-0">
            @include('admin.laporan.list')
        </div>

        <div class="card-footer">
            {{ $laporan->links() }}
        </div>

    </div>

</div>

@endsection