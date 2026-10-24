<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminDataController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->paginate(10);

        return view('admin.admin-data.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin-data.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:admins,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admin-data.index')
            ->with('success', 'Data admin berhasil ditambahkan.');
    }

    public function edit(Admin $adminDatum)
    {
        return view('admin.admin-data.edit', ['admin' => $adminDatum]);
    }

    public function update(Request $request, Admin $adminDatum)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:admins,username,' . $adminDatum->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $adminDatum->update($data);

        return redirect()->route('admin.admin-data.index')
            ->with('success', 'Data admin berhasil diperbarui.');
    }

    public function destroy(Admin $adminDatum)
    {
        if ((int) Auth::guard('admin')->id() === (int) $adminDatum->id) {
            return back()->withErrors([
                'admin' => 'Akun yang sedang login tidak dapat dihapus.',
            ]);
        }

        $adminDatum->delete();

        return back()->with('success', 'Data admin berhasil dihapus.');
    }
}
