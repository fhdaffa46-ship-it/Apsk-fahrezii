@extends('layouts.admin')
@section('title', 'Sarana')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 16px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid rgba(255,255,255,0.5);
    }

    .btn-modern {
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary-modern {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
    }

    .btn-warning-modern {
        background: rgba(251, 191, 36, 0.1);
        color: #d97706;
        border: 2px solid rgba(251, 191, 36, 0.2);
    }

    .btn-warning-modern:hover {
        background: rgba(251, 191, 36, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(251, 191, 36, 0.3);
    }

    .btn-danger-modern {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 2px solid rgba(239, 68, 68, 0.2);
    }

    .btn-danger-modern:hover {
        background: rgba(239, 68, 68, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
    }

    .table-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.5);
        backdrop-filter: blur(20px);
    }

    .table-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .table-header th {
        font-weight: 600;
        color: #475569;
        padding: 1.5rem 1rem;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .table-row {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(0,0,0,0.03);
    }

    .table-row:hover {
        background: linear-gradient(135deg, rgba(245,158,11,0.03) 0%, rgba(217,119,6,0.03) 100%);
        transform: scale(1.01);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .table-cell {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border: none;
    }

    .sarana-name {
        font-weight: 600;
        color: #1e293b;
        font-size: 1.05rem;
    }

    .empty-state {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        color: #64748b;
        border: 2px dashed rgba(100,116,139,0.3);
    }

    .empty-icon {
        font-size: 4rem;
        opacity: 0.5;
        margin-bottom: 1rem;
        display: block;
    }

    .alert-modern {
        background: linear-gradient(135deg, rgba(34,197,94,0.1) 0%, rgba(74,222,128,0.1) 100%);
        border: 1px solid rgba(34,197,94,0.2);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        backdrop-filter: blur(10px);
    }

    .pagination-modern .page-link {
        border-radius: 10px;
        margin: 0 2px;
        border: none;
        color: #64748b;
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(10px);
    }

    .pagination-modern .page-item.active .page-link {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        box-shadow: 0 4px 15px rgba(245,158,11,0.3);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-in {
        animation: fadeInUp 0.5s ease-out;
    }
</style>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header animate-in">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-0" style="background: linear-gradient(135deg, #f59e0b, #d97706); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Sarana</h4>
                <p class="text-muted mb-0 small">Kelola data sarana dan prasarana sekolah</p>
            </div>

            <a href="{{ route('admin.sarana.create') }}" 
               class="btn-modern btn-primary-modern animate-in" style="animation-delay: 0.1s;">
                <i class="bi bi-plus-lg"></i>
                Tambah Sarana
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-modern shadow-sm mb-4 animate-in" style="animation-delay: 0.2s;">
            <i class="bi bi-check-circle-fill me-2" style="color: #10b981; font-size: 1.2rem;"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Container -->
    <div class="table-container animate-in" style="animation-delay: 0.3s;">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-header">
                    <tr>
                        <th width="60"><i class="bi bi-hash"></i> No</th>
                        <th><i class="bi bi-building me-2"></i>Nama Sarana</th>
                        <th width="160" class="text-center"><i class="bi bi-gear me-1"></i>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sarana as $item)
                        <tr class="table-row">
                            <td class="table-cell fw-semibold text-muted">
                                {{ $loop->iteration + ($sarana->firstItem() - 1) }}
                            </td>

                            <td class="table-cell sarana-name">
                                {{ $item->nama_sarana }}
                            </td>

                            <td class="table-cell text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.sarana.edit', $item->id) }}"
                                       class="btn-modern btn-warning-modern btn-sm"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.sarana.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus sarana ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-modern btn-danger-modern btn-sm"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-0">
                                <div class="empty-state">
                                    <i class="bi bi-building empty-icon"></i>
                                    <h5 class="mb-2">Belum ada sarana</h5>
                                    <p class="mb-0">Tambahkan sarana pertama Anda untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($sarana->hasPages())
            <div class="card-footer bg-transparent border-0 p-3">
                <nav aria-label="Pagination">
                    {{ $sarana->links('pagination::bootstrap-5-modern') }}
                </nav>
            </div>
        @endif
    </div>
</div>
@endsection