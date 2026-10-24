<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanPengaduan;
use App\Models\Siswa;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalLaporan = LaporanPengaduan::count();

        $laporanMenunggu = LaporanPengaduan::where(function ($q) {
            $q->whereDoesntHave('aspirasi')
                ->orWhereHas('aspirasi', function ($sub) {
                    $sub->where('status', 'menunggu');
                });
        })->count();

        $laporanProses = LaporanPengaduan::whereHas('aspirasi', function ($q) {
            $q->where('status', 'proses');
        })->count();

        $laporanSelesai = LaporanPengaduan::whereHas('aspirasi', function ($q) {
            $q->where('status', 'selesai');
        })->count();

        $laporanTerbaru = LaporanPengaduan::with(['siswa', 'kategori', 'aspirasi'])
            ->latest()
            ->take(5)
            ->get();

        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $rekapLaporan = [
            'harian' => LaporanPengaduan::whereDate('created_at', Carbon::today())->count(),
            'mingguan' => LaporanPengaduan::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
            'bulanan' => LaporanPengaduan::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count(),
        ];

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalLaporan',
            'laporanMenunggu',
            'laporanProses',
            'laporanSelesai',
            'laporanTerbaru',
            'rekapLaporan'
        ));
    }
}
