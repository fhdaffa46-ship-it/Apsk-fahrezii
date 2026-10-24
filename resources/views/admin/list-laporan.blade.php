<div class="card border-0 shadow-sm" style="backdrop-filter: blur(20px); background: rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.4);">
    
    {{-- HEADER --}}
    <div class="card-header bg-gradient" style="
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: none;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.25rem 1.5rem;
    ">
        <div class="d-flex align-items-center gap-2">
            <div style="
                width: 36px; height: 36px; 
                background: linear-gradient(135deg, #3b82f6, #1d4ed8);
                border-radius: 10px;
                display: flex; align-items: center; justify-content: center;
                color: white; font-size: 16px; font-weight: 600;
                flex-shrink: 0;
                box-shadow: 0 4px 12px rgba(59,130,246,0.3);
            ">📋</div>
            <div>
                <h6 class="mb-0 fw-bold" style="color: #1e293b; font-size: 1.1rem;">Laporan Terbaru</h6>
                <small class="text-muted">5 laporan terakhir</small>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size: 0.95rem;">
                <thead style="
                    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                    border-bottom: 2px solid rgba(0,0,0,0.05);
                ">
                    <tr>
                        <th style="padding: 1rem 1rem; font-weight: 600; color: #475569; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; border: none;">#</th>
                        <th style="padding: 1rem 1rem; font-weight: 600; color: #475569; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; border: none;">Siswa</th>
                        <th style="padding: 1rem 1rem; font-weight: 600; color: #475569; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; border: none;">Kategori</th>
                        <th style="padding: 1rem 1rem; font-weight: 600; color: #475569; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; border: none;">Status</th>
                        <th style="padding: 1rem 1rem; font-weight: 600; color: #475569; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; border: none;">Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporanTerbaru ?? [] as $item)
                        <tr style="
                            transition: all 0.3s ease;
                            border-bottom: 1px solid rgba(0,0,0,0.03);
                        " onmouseover="this.style.background='linear-gradient(90deg, rgba(59,130,246,0.04), transparent)'" onmouseout="this.style.background=''">
                            
                            <td style="
                                padding: 1rem; 
                                color: #94a3b8; 
                                font-weight: 500; 
                                font-size: 0.9rem;
                                border: none;
                                width: 50px;
                            ">
                                {{ $loop->iteration }}
                            </td>

                            <td style="
                                padding: 1rem; 
                                font-weight: 600; 
                                color: #1e293b;
                                border: none;
                            ">
                                {{ $item->siswa->nama ?? '-' }}
                            </td>

                            <td style="
                                padding: 1rem; 
                                color: #475569;
                                border: none;
                            ">
                                <span style="
                                    background: rgba(100,116,139,0.1);
                                    color: #475569;
                                    padding: 0.375rem 0.75rem;
                                    border-radius: 20px;
                                    font-size: 0.8rem;
                                    font-weight: 500;
                                ">{{ $item->kategori->nama_kategori ?? '-' }}</span>
                            </td>

                            {{-- STATUS --}}
                            <td style="padding: 1rem; border: none; text-align: center;">
                                @php
                                    $status = $item->aspirasi?->status ?? 'menunggu';

                                    $statusConfig = match($status) {
                                        'selesai' => ['color' => '#10b981', 'bg' => 'rgba(16,185,129,0.15)'],
                                        'diproses' => ['color' => '#3b82f6', 'bg' => 'rgba(59,130,246,0.15)'],
                                        'ditolak' => ['color' => '#ef4444', 'bg' => 'rgba(239,68,68,0.15)'],
                                        default => ['color' => '#f59e0b', 'bg' => 'rgba(245,158,11,0.15)'],
                                    };
                                @endphp

                                <span style="
                                    background: {{ $statusConfig['bg'] }};
                                    color: {{ $statusConfig['color'] }};
                                    padding: 0.4rem 0.8rem;
                                    border-radius: 25px;
                                    font-size: 0.75rem;
                                    font-weight: 600;
                                    box-shadow: 0 2px 8px {{ str_replace('0.15', '0.25', $statusConfig['bg']) }};
                                    transition: all 0.2s ease;
                                " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform=''">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td style="
                                padding: 1rem; 
                                color: #94a3b8;
                                font-size: 0.9rem;
                                border: none;
                            ">
                                {{ $item->created_at->format('d M Y') }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="
                                padding: 3rem 1rem;
                                text-align: center;
                                color: #94a3b8;
                                font-style: italic;
                                border: none;
                            ">
                                <div style="font-size: 3rem; opacity: 0.3; margin-bottom: 0.5rem;">📭</div>
                                Belum ada laporan
                            </div>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>