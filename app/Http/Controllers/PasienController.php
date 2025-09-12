<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = User::where('role', 'pasien')->with('pasien')->get();
        return view('pasien.index', compact('pasien'));
    }

    public function create()
    {
        return view('pasien.tambah');
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
            $data['role'] = 'pasien';
            $user = User::create($data);
            DB::commit();
            return redirect()->route('pasien.index')->with('success', "data {$user->username} berhasil ditambahkan");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal menambahkan data pasien: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $pasien = User::where('role', 'pasien')->with('pasien')->findOrFail($id);
        return view('pasien.show', compact('pasien'));
    }

    public function edit($id)
    {
        $pasien = User::where('role', 'pasien')->with('pasien')->findOrFail($id);
        return view('pasien.edit', compact('pasien'));
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
            return redirect()->route('pasien.index')->with('success', "data {$user->username} berhasil diperbarui");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal memperbarui data pasien: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            if ($user->pasien) {
                $user->pasien->delete();
            }
            $user->delete();
            DB::commit();
            return redirect()->route('pasien.index')->with('success', "data {$user->username} berhasil dihapus");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal menghapus data pasien: ' . $e->getMessage()]);
        }
    }

    public function downloadPDF(Request $request)
    {
        $bpjs = $request->query('bpjs');
        $pasien = [];

        if($bpjs == 1){
            // Pasien BPJS - yang memiliki no_bpjs
            $pasien = Pasien::whereNotNull('no_bpjs')->get();
        } else {
            // Pasien Non-BPJS - yang tidak memiliki no_bpjs
            $pasien = Pasien::whereNull('no_bpjs')->get();
        }

        $filename = $bpjs == 1 ? 'laporan-pasien-bpjs.pdf' : 'laporan-pasien-non-bpjs.pdf';

        return PDF::loadView('pasien.report', compact('pasien'))
            ->stream($filename);
    }
}
