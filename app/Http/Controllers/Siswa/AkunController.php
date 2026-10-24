<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AkunController extends Controller
{
    public function edit()
    {
        return view('siswa.akun', [
            'siswa' => Auth::guard('siswa')->user(),
        ]);
    }

    public function update(Request $request)
    {
        /** @var \App\Models\Siswa $siswa */
        $siswa = Auth::guard('siswa')->user();

        $request->validate([
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
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
            if ($siswa->foto_profil) {
                Storage::disk('public')->delete($siswa->foto_profil);
            }

            $data['foto_profil'] = $request->file('foto_profil')
                ->store('siswa/foto-profil', 'public');
        }

        $siswa->update($data);

        return redirect()
            ->route('siswa.akun.edit')
            ->with('success', 'Data akun berhasil diperbarui.');
    }
}
