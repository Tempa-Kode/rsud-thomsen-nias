<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PimpinanController extends Controller
{
    public function index()
    {
        $pimpinan = User::where('role', 'pimpinan')->with('pimpinan')->get();
        return view('pimpinan.index', compact('pimpinan'));
    }

    public function create()
    {
        return view('pimpinan.tambah');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);
        DB::beginTransaction();
        try {
            $data['password'] = bcrypt($data['password']);
            $data['role'] = 'pimpinan';
            $user = User::create($data);
            DB::commit();
            return redirect()->route('pimpinan.index')->with('success', "data {$user->username} berhasil ditambahkan");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal menambahkan data pimpinan: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $pimpinan = User::where('role', 'pimpinan')->with('pimpinan')->findOrFail($id);
        return view('pimpinan.show', compact('pimpinan'));
    }

    public function edit($id)
    {
        $pimpinan = User::where('role', 'pimpinan')->with('pimpinan')->findOrFail($id);
        return view('pimpinan.edit', compact('pimpinan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'username.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->username = $data['username'];
            $user->email = $data['email'];
            if (!empty($data['password'])) {
                $user->password = bcrypt($data['password']);
            }
            $user->save();
            DB::commit();
            return redirect()->route('pimpinan.index')->with('success', "data {$user->username} berhasil diperbarui");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal memperbarui data pimpinan: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            if ($user->pimpinan) {
                $user->pimpinan->delete();
            }
            $user->delete();
            DB::commit();
            return redirect()->route('pimpinan.index')->with('success', "data {$user->username} berhasil dihapus");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal menghapus data pimpinan: ' . $e->getMessage()]);
        }
    }
}
