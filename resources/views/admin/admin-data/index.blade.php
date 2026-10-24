@extends('layouts.admin')
@section('title', 'Data Admin')

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
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
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
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .table-row {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(0,0,0,0.03);
    }

    .table-row:hover {
        background: linear-gradient(135deg, rgba(239,68,68,0.03) 0%, rgba(220,38,38,0.03) 100%);
        transform: scale(1.01);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .table-cell {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border: none;
    }

    .admin-name {
        font-weight: 600;
        color: #1e293b;
        font-size: 1rem;
    }

    .admin-username {
        color: #475569;
        font-weight: 500;
        background: rgba(107,114,128,0.1);
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        display: inline-block;
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
        opacity: 0.4;
        margin-bottom: 1rem;
        display: block;
    }

    .alert-modern {
        border-radius: 12px;
        backdrop-filter: blur(10px);
        border: none;
        padding: 1rem 1.25rem;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(74,222,128,0.15) 100%);
        border: 1px solid rgba(34,197,94,0.3);
        color: #166534;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(239,68,68,0.15) 0%, rgba(220,38,38,0.15) 100%);
        border: 1px solid rgba(239,68,68,0.3);
        color: #991b1b;
    }

    .pagination-modern .page-link {
        border-radius: 10px;
        margin: 0 2px;
        border: none;
        color: #64748b;
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(10px);
    }

    .pagination-modern .page-item.active .page-link {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        box-shadow: 0 4px 15px rgba(239,68,68,0.3);
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

<div class="container-fluid py-3">
    <!-- Page Header -->
    <div class="page-header animate-in">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-0" style="background: linear-gradient(135deg, #ef4444, #dc2626); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Data Admin</h4>
                <p class="text-muted mb-0 small">Kelola akun administrator sistem</p>
            </div>

            <a href="{{ route('admin.admin-data.create') }}" 
               class="btn-modern btn-primary-modern animate-in" style="animation-delay: 0.1s;">
                <i class="bi bi-person-plus"></i>
                Tambah Admin
            </a>
        </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div class="alert alert-modern alert-success shadow-sm mb-4 animate-in" style="animation-delay: 0.2s;">
            <i class="bi bi-check-circle-fill me-2" style="color: #10b981; font-size: 1.1rem;"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->has('admin'))
        <div class="alert alert-modern alert-danger shadow-sm mb-4 animate-in" style="animation-delay: 0.2s;">
            <i class="bi bi-exclamation-triangle-fill me-2" style="color: #ef4444; font-size: 1.1rem;"></i>
            {{ $errors->first('admin') }}
        </div>
    @endif

    <!-- Table Container -->
    <div class="table-container animate-in" style="animation-delay: 0.3s;">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-header">
                    <tr>
                        <th width="60"><i class="bi bi-hash"></i> No</th>
                        <th><i class="bi bi-person-circle me-2"></i>Nama</th>
                        <th><i class="bi bi-person-lines-fill me-2"></i>Username</th>
                        <th width="170" class="text-center"><i class="bi bi-gear me-1"></i>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($admins as $admin)
                        <tr class="table-row">
                            <td class="table-cell fw-semibold text-muted">
                                {{ $loop->iteration + ($admins->firstItem() - 1) }}
                            </td>

                            <td class="table-cell admin-name">
                                {{ $admin->nama }}
                            </td>

                            <td class="table-cell">
                                <span class="admin-username">{{ $admin->username }}</span>
                            </td>

                            <td class="table-cell text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.admin-data.edit', $admin->id) }}"
                                       class="btn-modern btn-warning-modern btn-sm"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.admin-data.destroy', $admin->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
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
                            <td colspan="4" class="p-0">
                                <div class="empty-state">
                                    <i class="bi bi-people empty-icon"></i>
                                    <h5 class="mb-2">Belum ada admin</h5>
                                    <p class="mb-0">Tambahkan admin pertama untuk mengelola sistem</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($admins->hasPages())
            <div class="card-footer bg-transparent border-0 p-3">
                <nav class="pagination-modern">
                    {{ $admins->links('pagination::bootstrap-5-modern') }}
                </nav>
            </div>
        @endif
    </div>
</div>
@endsection