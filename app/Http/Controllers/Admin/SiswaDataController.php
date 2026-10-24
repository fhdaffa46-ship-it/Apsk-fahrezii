<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaDataController extends Controller
{
    public function index()
    {
        $siswas = Siswa::latest()->paginate(10);

        return view('admin.siswa-data.index', compact('siswas'));
    }

    public function create()
    {
        return view('admin.siswa-data.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|max:30|unique:siswas,nis',
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ];

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')
                ->store('siswa/foto-profil', 'public');
        }

        Siswa::create($data);

        return redirect()->route('admin.siswa-data.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswaDatum)
    {
        return view('admin.siswa-data.edit', ['siswa' => $siswaDatum]);
    }

    public function update(Request $request, Siswa $siswaDatum)
    {
        $request->validate([
            'nis' => 'required|string|max:30|unique:siswas,nis,' . $siswaDatum->id,
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ];

        if ($request->hasFile('foto_profil')) {
            if ($siswaDatum->foto_profil) {
                Storage::disk('public')->delete($siswaDatum->foto_profil);
            }

            $data['foto_profil'] = $request->file('foto_profil')
                ->store('siswa/foto-profil', 'public');
        }

        $siswaDatum->update($data);

        return redirect()->route('admin.siswa-data.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswaDatum)
    {
        if ($siswaDatum->foto_profil) {
            Storage::disk('public')->delete($siswaDatum->foto_profil);
        }

        $siswaDatum->delete();

        return back()->with('success', 'Data siswa berhasil dihapus.');
    }
}
