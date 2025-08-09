<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        $kasir = User::where('role', 'kasir')->with('kasir')->get();
        return view('kasir.index', compact('kasir'));
    }

    public function create()
    {
        return view('kasir.tambah');
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
            $data['role'] = 'kasir';
            $user = User::create($data);
            DB::commit();
            return redirect()->route('kasir.index')->with('success', "data {$user->username} berhasil ditambahkan");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal menambahkan data kasir: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $kasir = User::where('role', 'kasir')->with('kasir')->findOrFail($id);
        return view('kasir.show', compact('kasir'));
    }

    public function edit($id)
    {
        $kasir = User::where('role', 'kasir')->with('kasir')->findOrFail($id);
        return view('kasir.edit', compact('kasir'));
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
            return redirect()->route('kasir.index')->with('success', "data {$user->username} berhasil diperbarui");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal memperbarui data kasir: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            if ($user->kasir) {
                $user->kasir->delete();
            }
            $user->delete();
            DB::commit();
            return redirect()->route('kasir.index')->with('success', "data {$user->username} berhasil dihapus");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal menghapus data kasir: ' . $e->getMessage()]);
        }
    }
}
