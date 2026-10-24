<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\LaporanPengaduan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aspirasi;
use Illuminate\Support\Carbon;

class LaporanAspirasiController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->input('periode');
        $query = LaporanPengaduan::with(['siswa', 'kategori', 'aspirasi', 'lokasiRef', 'sarana'])
            ->latest();

        $this->applyPeriodeFilter($query, $periode);

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }


        if ($request->filled('status')) {
            $this->applyStatusFilter($query, $request->status);
        }

        $laporan = $query->paginate(10)->withQueryString();

        $kepuasan = [
            1 => 'Tidak Puas',
            2 => 'Kurang Puas',
            3 => 'Cukup Puas',
            4 => 'Puas',
            5 => 'Sangat Puas',
        ];

        $laporan->getCollection()->transform(function ($item) use ($kepuasan) {
            $item->status = $item->aspirasi?->status;

            $nilai = $item->aspirasi?->feedback ?? null;
            $item->feedback = $nilai
                ? $kepuasan[$nilai] ?? '-'
                : 'Belum ada feedback';

            return $item;
        });

        $rekapBase = LaporanPengaduan::query();

        if ($request->filled('kategori_id')) {
            $rekapBase->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('status')) {
            $this->applyStatusFilter($rekapBase, $request->status);
        }

        $rekapLaporan = [
            'harian' => (clone $rekapBase)
                ->whereDate('created_at', Carbon::today())
                ->count(),
            'mingguan' => (clone $rekapBase)
                ->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(Carbon::MONDAY),
                    Carbon::now()->endOfWeek(Carbon::SUNDAY),
                ])->count(),
            'bulanan' => (clone $rekapBase)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count(),
        ];

        $kategoriList = Kategori::orderBy('nama_kategori')->get();

        return view('admin.laporan.index', compact('laporan', 'rekapLaporan', 'periode', 'kategoriList'));
    }

    public function exportPdf(Request $request)
    {
        $periode = $request->input('periode', 'harian');

        $query = LaporanPengaduan::with(['siswa', 'kategori', 'aspirasi', 'lokasiRef', 'sarana'])
            ->latest();

        $this->applyPeriodeFilter($query, $periode);

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('status')) {
            $this->applyStatusFilter($query, $request->status);
        }

        $laporan = $query->get();

        $labelPeriode = [
            'harian' => 'Harian',
            'mingguan' => 'Mingguan',
            'bulanan' => 'Bulanan',
        ];

        $pdf = Pdf::loadView('admin.laporan.export-pdf', [
            'laporan' => $laporan,
            'periode' => $labelPeriode[$periode] ?? 'Harian',
            'tanggalCetak' => Carbon::now()->format('d-m-Y H:i'),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-aspirasi-' . $periode . '-' . now()->format('Ymd_His') . '.pdf');
    }

    public function show(LaporanPengaduan $laporan)
    {
        $laporan->load(['kategori', 'aspirasi', 'lokasiRef', 'sarana']);

        $kepuasan = [
            1 => 'Tidak Puas',
            2 => 'Kurang Puas',
            3 => 'Cukup Puas',
            4 => 'Puas',
            5 => 'Sangat Puas',
        ];

        if ($laporan->aspirasi?->feedback) {
            $laporan->feedback = $kepuasan[$laporan->aspirasi->feedback] ?? '-';
        } else {
            $laporan->feedback = 'Belum ada feedback';
        }

        return view('admin.laporan.show', compact('laporan'));
    }

    public function update(Request $request, LaporanPengaduan $laporan)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai',
        ]);

        Aspirasi::updateOrCreate(
            [
                'laporan_id' => $laporan->id,
            ],
            [
                'admin_id' => Auth::guard('admin')->id(),
                'status' => $request->status,
            ]
        );

        return redirect()
            ->route('admin.laporan.show', $laporan->id)
            ->with('success', 'Status aspirasi berhasil diperbarui.');
    }

    private function applyStatusFilter($query, string $status): void
    {
        if ($status === 'belum') {
            $query->where(function ($q) {
                $q->whereDoesntHave('aspirasi')
                    ->orWhereHas('aspirasi', function ($sub) {
                        $sub->where('status', 'menunggu');
                    });
            });

            return;
        }

        $query->whereHas('aspirasi', function ($q) use ($status) {
            $q->where('status', $status);
        });
    }

    private function applyPeriodeFilter($query, ?string $periode): void
    {
        if ($periode === 'harian') {
            $query->whereDate('created_at', Carbon::today());
            return;
        }

        if ($periode === 'mingguan') {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfWeek(Carbon::MONDAY),
                Carbon::now()->endOfWeek(Carbon::SUNDAY),
            ]);
            return;
        }

        if ($periode === 'bulanan') {
            $query->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month);
        }
    }
}
