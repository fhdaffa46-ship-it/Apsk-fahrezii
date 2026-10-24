@extends('layouts.siswa')

@section('content')
<style>
    .dashboard-card {
        border-radius: 18px;
        overflow: hidden;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #4e73df, #224abe);
        color: white;
        padding: 15px 20px;
    }

    .btn-add {
        border-radius: 50px;
        font-size: 14px;
        padding: 6px 16px;
        background: white;
        color: #4e73df;
        border: none;
        transition: 0.3s;
    }

    .btn-add:hover {
        background: #f1f3ff;
        transform: translateY(-2px);
    }

    .table thead {
        background: #f8f9fc;
    }

    .table tbody tr:hover {
        background-color: #f1f5ff;
        transition: 0.2s;
    }

    .card-footer {
        background: transparent;
    }
</style>

<div class="card shadow mt-3 dashboard-card">

    {{-- HEADER --}}
    <div class="dashboard-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">📋 Riwayat Laporan Saya</h5>

        <a href="{{ route('siswa.laporan.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Buat Pengaduan
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="px-3 pt-3">
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card-body p-0 table-responsive">
        @include('siswa.partials.list-dashboard')
    </div>

    {{-- PAGINATION --}}
    <div class="card-footer pb-2 pt-3 text-center">
        {{ $laporan->links() }}
    </div>

</div>
@endsection