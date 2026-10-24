<div class="card">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Foto Profil Mahasiswa</th>
                <td>
                    <img
                        src="{{ $laporan->siswa->foto_profil ? asset('storage/' . $laporan->siswa->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($laporan->siswa->nama) . '&background=0D8ABC&color=fff' }}"
                        alt="Foto Mahasiswa"
                        class="img-thumbnail"
                        style="max-width: 120px;">
                </td>
            </tr>
            <tr>
                <th width="200">Nama Mahasiswa</th>
                <td>{{ $laporan->siswa->nama }}</td>
            </tr>
            <tr>
                <th width="200">NIM</th>
                <td>{{ $laporan->siswa->nim }}</td>
            </tr>
            <tr>
                <th width="200">Kelas</th>
                <td>{{ $laporan->siswa->kelas }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $laporan->kategori->nama_kategori }}</td>
            </tr>
            <tr>
                <th>Laporan</th>
                <td>{{ $laporan->ket }}</td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td>{{ $laporan->lokasiRef->nama_lokasi ?? $laporan->lokasi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Sarana</th>
                <td>{{ $laporan->sarana->nama_sarana ?? '-' }}</td>
            </tr>
            <tr>
                <th>Gambar Laporan</th>
                <td>
                    @if ($laporan->gambar)
                        <img src="{{ asset('storage/' . $laporan->gambar) }}"
                            alt="Gambar Laporan"
                            class="img-fluid rounded border"
                            style="max-width: 300px;">
                    @else
                        <span class="text-muted">Tidak ada gambar.</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status Saat Ini</th>
                <td>
                    @if ($laporan->aspirasi?->status === 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @elseif ($laporan->aspirasi?->status === 'proses')
                        <span class="badge bg-warning">Proses</span>
                    @else
                        <span class="badge bg-secondary">Belum Diproses</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Feedback Kepuasan</th>
                <td>
                    <span class="badge bg-info">
                        {{ $laporan->feedback }}
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>