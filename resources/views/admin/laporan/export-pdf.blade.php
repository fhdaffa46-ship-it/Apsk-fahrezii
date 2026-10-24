<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Export Laporan Aspirasi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        h2, p {
            margin: 0;
        }

        .header {
            margin-bottom: 16px;
        }

        .meta {
            margin-top: 6px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #bbb;
            padding: 6px 8px;
            vertical-align: top;
        }

        th {
            background: #f1f5f9;
            text-align: left;
        }

        .empty {
            text-align: center;
            color: #666;
            padding: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Rekap Laporan Aspirasi {{ $periode }}</h2>
        <p class="meta">Tanggal Cetak: {{ $tanggalCetak }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Siswa</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Sarana</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->created_at?->format('d-m-Y') }}</td>
                    <td>{{ $item->siswa->nama ?? '-' }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->lokasiRef->nama_lokasi ?? $item->lokasi ?? '-' }}</td>
                    <td>{{ $item->sarana->nama_sarana ?? '-' }}</td>
                    <td>{{ $item->ket }}</td>
                    <td>{{ ucfirst($item->aspirasi?->status ?? 'menunggu') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty">Data laporan tidak tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
