<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        $role = $user->role;

        // Only load the specific relationship needed
        $data = User::where('id', $user->id)->with($role)->first();
        $relasiData = $data->$role;
        return view('profil.index', compact('data', 'role', 'relasiData'));
    }

    public function updateDataPasien(Request $request)
    {
        $data = $request->validate([
            'no_bpjs' => 'nullable|numeric',
            'nik' => 'required|numeric',
            'nama' => 'required|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'agama' => 'required|max:20',
            'pekerjaan' => 'required|max:30',
        ], [
            'nik.required' => 'NIK harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'tinggi_badan.required' => 'Tinggi badan harus diisi.',
            'berat_badan.required' => 'Berat badan harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'agama.required' => 'Agama harus dipilih.',
            'pekerjaan.required' => 'Pekerjaan harus diisi.',
        ]);

        DB::beginTransaction();
        try {
            $data['user_id'] = Auth::user()->id;
            $pasien = Pasien::where('user_id', $data['user_id'])->first();
            if ($pasien) {
                $pasien->update($data);
            } else {
                Pasien::create($data);
            }
            DB::commit();
            return redirect()->route('profile.index')->with('success', 'Data pasien berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('profile.index')->with('error', 'Gagal memperbarui data pasien: ' . $e->getMessage());
        }
    }
}
