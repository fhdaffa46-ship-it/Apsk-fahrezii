<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sarana;
use Illuminate\Http\Request;

class SaranaController extends Controller
{
    public function index()
    {
        $sarana = Sarana::latest()->paginate(10);

        return view('admin.sarana.index', compact('sarana'));
    }

    public function create()
    {
        return view('admin.sarana.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sarana' => 'required|string|max:120|unique:saranas,nama_sarana',
        ]);

        Sarana::create($request->only('nama_sarana'));

        return redirect()->route('admin.sarana.index')
            ->with('success', 'Sarana berhasil ditambahkan.');
    }

    public function edit(Sarana $sarana)
    {
        return view('admin.sarana.edit', compact('sarana'));
    }

    public function update(Request $request, Sarana $sarana)
    {
        $request->validate([
            'nama_sarana' => 'required|string|max:120|unique:saranas,nama_sarana,' . $sarana->id,
        ]);

        $sarana->update($request->only('nama_sarana'));

        return redirect()->route('admin.sarana.index')
            ->with('success', 'Sarana berhasil diperbarui.');
    }

    public function destroy(Sarana $sarana)
    {
        $sarana->delete();

        return back()->with('success', 'Sarana berhasil dihapus.');
    }
}
