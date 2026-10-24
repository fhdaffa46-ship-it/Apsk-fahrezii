<table class="table table-hover mb-0">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Keterangan Laporan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($laporan as $item)
            <tr>
                <td>{{ $loop->iteration + ($laporan->firstItem() - 1) }}</td>
                <td>
                    {{ $item->ket }}
                    <p>
                        <small class="text-muted">
                            {{ $item->created_at->format('d M Y') }}
                        </small>
                    </p>
                    <p class="text-muted">
                        Kategori : {{ $item->kategori->nama_kategori ?? '-' }},
                        Lokasi : {{ $item->lokasiRef->nama_lokasi ?? $item->lokasi ?? '-' }},
                        Sarana : {{ $item->sarana->nama_sarana ?? '-' }},
                        Gambar :
                        @if ($item->gambar)
                            <span class="badge bg-success">Ada</span>
                        @else
                            <span class="badge bg-secondary">Tidak ada</span>
                        @endif,
                        Feedback : {{ $item->feedback }}
                    </p>
                </td>
                <td>
                    @if ($item->status == 'proses')
                        <span class="badge bg-warning text-dark">Diproses</span>
                    @elseif ($item->status == 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="badge bg-light text-dark">Menunggu</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('siswa.laporan.show', $item->id) }}" 
                    class="btn btn-sm btn-primary">
                        <i class="bi bi-eye"></i>
                </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    Belum ada laporan
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
