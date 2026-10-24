<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\LaporanPengaduan;
use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Sarana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanPengaduanController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $lokasi = Lokasi::orderBy('nama_lokasi')->get();
        $sarana = Sarana::orderBy('nama_sarana')->get();

        return view('siswa.laporan.create', compact('kategori', 'lokasi', 'sarana'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi_id'   => 'required|exists:lokasis,id',
            'sarana_id'   => 'required|exists:saranas,id',
            'ket'         => 'required|string',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $lokasi = Lokasi::findOrFail($request->lokasi_id);
        $pathGambar = $request->file('gambar')->store('laporan/gambar', 'public');

        LaporanPengaduan::create([
            'siswa_id'   => Auth::guard('siswa')->user()->id,
            'kategori_id' => $request->kategori_id,
            'lokasi_id'  => $request->lokasi_id,
            'sarana_id'  => $request->sarana_id,
            'ket'        => $request->ket,
            'lokasi'     => $lokasi->nama_lokasi,
            'gambar'     => $pathGambar,
        ]);

        return redirect()
            ->route('siswa.dashboard')
            ->with('success', 'Laporan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanPengaduan $laporan)
    {
        $laporan->load(['siswa', 'aspirasi', 'kategori', 'lokasiRef', 'sarana']);

        return view('siswa.laporan.show', [
            'laporan' => $laporan,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanPengaduan $laporan)
    {
        if ($laporan->gambar) {
            Storage::disk('public')->delete($laporan->gambar);
        }

        $laporan->delete();

        return redirect()
            ->route('siswa.dashboard')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    public function feedback(Request $request, Aspirasi $aspirasi)
    {
        $request->validate([
            'feedback' => 'required|integer|min:1|max:5',
        ]);

        $aspirasi->update($request->all());

        return redirect()
            ->route('siswa.dashboard')
            ->with('success', 'Terima kasih atas feedback Anda.');
    }
}
