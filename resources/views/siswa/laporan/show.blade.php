@extends('layouts.siswa')

@section('title', 'Laporan Pengaduan')

@section('content')
<style>
/* Modern Detail Page */
.detail-card-modern {
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.08);
    border: 1px solid rgba(255,255,255,0.2);
    background: #ffffff;
}

.detail-header-modern {
    background: linear-gradient(135deg, #64748b 0%, #475569 100%);
    color: white;
    padding: 2.5rem 2.5rem 2rem;
    position: relative;
}

.detail-header-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #10b981, #f59e0b);
}

.detail-title-modern {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    position: relative;
    z-index: 2;
}

.meta-info-modern {
    padding: 2.5rem 2.5rem 1.5rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 1px solid #e2e8f0;
}

.meta-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.meta-item-modern {
    display: flex;
    flex-direction: column;
}

.meta-label-modern {
    font-size: 0.8rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.25rem;
}

.meta-value-modern {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    word-break: break-word;
}

.content-section-modern {
    padding: 2.5rem;
}

.description-modern {
    background: #f8fafc;
    border-radius: 16px;
    padding: 1.75rem 1.5rem;
    border-left: 4px solid #3b82f6;
    margin-bottom: 2rem;
    line-height: 1.7;
}

.image-gallery-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 150px));
    gap: 1rem;
    margin-bottom: 2rem;
}

.image-modern {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    aspect-ratio: 1;
}

.image-modern:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.image-modern img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.image-modern:hover img {
    transform: scale(1.1);
}

.status-badge-modern {
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.status-diproses {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: #92400e;
}

.status-selesai {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #065f46;
}

.status-ditolak {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #991b1b;
}

.action-buttons-modern {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-modern-detail {
    border-radius: 12px;
    padding: 0.875rem 1.75rem;
    font-weight: 600;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.btn-primary-modern-detail {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    box-shadow: 0 6px 20px rgba(59,130,246,0.3);
}

.btn-primary-modern-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(59,130,246,0.4);
}

.btn-secondary-modern-detail {
    background: transparent;
    color: #374151;
    border-color: #d1d5db;
}

.btn-secondary-modern-detail:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
    transform: translateY(-2px);
}

.divider-modern {
    height: 1px;
    background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
    margin: 2.5rem 0;
}

@media (max-width: 768px) {
    .meta-grid-modern {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .content-section-modern,
    .meta-info-modern,
    .report-header-modern {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
}
</style>

<div class="detail-card-modern mt-5 mb-5">
    {{-- HEADER --}}
    <div class="detail-header-modern position-relative">
        <div class="position-relative z-2">
            <h1 class="detail-title-modern mb-2">
                <i class="bi bi-file-earmark-text-fill me-3"></i>
                Detail Laporan #{{ $laporan->id }}
            </h1>
            <div class="status-badge-modern {{ $laporan->status === 'diproses' ? 'status-diproses' : ($laporan->status === 'selesai' ? 'status-selesai' : 'status-ditolak') }}">
                {{ ucfirst($laporan->status) }}
            </div>
        </div>
    </div>

    {{-- META INFO --}}
    <div class="meta-info-modern">
        <div class="meta-grid-modern">
            <div class="meta-item-modern">
                <div class="meta-label-modern">🏷️ Kategori</div>
                <div class="meta-value-modern">{{ $laporan->kategori->nama_kategori ?? '-' }}</div>
            </div>
            <div class="meta-item-modern">
                <div class="meta-label-modern">📍 Lokasi</div>
                <div class="meta-value-modern">{{ $laporan->lokasiRef->nama_lokasi ?? $laporan->lokasi ?? '-' }}</div>
            </div>
            <div class="meta-item-modern">
                <div class="meta-label-modern">🏢 Sarana</div>
                <div class="meta-value-modern">{{ $laporan->sarana->nama_sarana ?? '-' }}</div>
            </div>
            <div class="meta-item-modern">
                <div class="meta-label-modern">📅 Dibuat</div>
                <div class="meta-value-modern">
                    {{ $laporan->created_at->format('d M Y, H:i') }}<br>
                    <small class="text-muted">{{ $laporan->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content-section-modern">
        {{-- KETERANGAN --}}
        <div class="description-modern">
            <h6 class="fw-semibold mb-3 text-primary">
                <i class="bi bi-chat-square-text-fill me-2"></i>
                Keterangan Lengkap
            </h6>
            <p class="mb-0 lh-lg">{{ $laporan->ket }}</p>
        </div>

        {{-- GAMBAR --}}
        @if ($laporan->gambar)
            <div>
                <h6 class="fw-semibold mb-3 text-primary">
                    <i class="bi bi-images me-2"></i>
                    Bukti Foto
                </h6>
                <div class="image-gallery-modern">
                    @foreach(explode(',', $laporan->gambar) as $gambar)
                        @php $gambar = trim($gambar) @endphp
                        @if($gambar)
                            <div class="image-modern" onclick="openImageModal('{{ asset('storage/' . $gambar) }}')">
                                <img src="{{ asset('storage/' . $gambar) }}" alt="Bukti {{ $loop->iteration }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-5 bg-light rounded-3">
                <i class="bi bi-image fs-1 text-muted mb-3"></i>
                <p class="text-muted mb-0">Tidak ada gambar bukti</p>
            </div>
        @endif

        {{-- DIVIDER --}}
        <div class="divider-modern"></div>

        {{-- TANGGAPAN --}}
        @include('siswa.laporan.tanggapan')

        {{-- FEEDBACK --}}
        @if (isset($laporan->aspirasi) && $laporan->aspirasi?->status === 'selesai')
            @include('siswa.laporan.feedback')
        @endif
    </div>

    {{-- ACTION BUTTONS --}}
    <div class="px-4 pb-4 pt-2 bg-light">
        <div class="action-buttons-modern justify-content-center justify-content-md-start">
            <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary-modern-detail btn-modern-detail">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
            </a>
            @if($laporan->status === 'diproses')
                <a href="{{ route('siswa.laporan.edit', $laporan->id) }}" class="btn btn-primary-modern-detail btn-modern-detail">
                    <i class="bi bi-pencil-square me-2"></i>Edit Laporan
                </a>
            @endif
        </div>
    </div>
</div>

{{-- Image Modal --}}
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body p-0">
                <img id="modalImage" src="" class="img-fluid w-100" style="max-height: 80vh; object-fit: contain;">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-4" data-bs-dismiss="modal"></button>
            </div>
        </div>
    </div>
</div>

<script>
function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    new bootstrap.Modal(document.getElementById('imageModal')).show();
}

// Smooth scroll to tanggapan section
document.querySelectorAll('a[href*="#tanggapan"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });
});
</script>
@endsection