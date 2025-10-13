<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\Pasien;
use App\Models\Pimpinan;
use App\Models\Dokter;
use App\Models\Poli;
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
        if ($role == 'dokter') {
            $poli = Poli::all();
            return view('profil.index', compact('data', 'role', 'relasiData', 'poli'));
        }
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

    public function updateDataPimpinan(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $pimpinan = Pimpinan::where('user_id', $user->id)->first();

            if (!$pimpinan) {
                $data['user_id'] = $user->id;
                $pimpinan = Pimpinan::create($data);
            }

            DB::commit();

            return redirect()->route('profile.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateDataKasir(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'jam_mulai_kerja' => 'required|date_format:H:i',
            'jam_selesai_kerja' => 'required|date_format:H:i|after:jam_mulai_kerja',
            'hari_kerja' => 'required|min:1',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'jam_mulai_kerja.required' => 'Jam mulai kerja harus diisi.',
            'jam_selesai_kerja.required' => 'Jam selesai kerja harus diisi.',
            'jam_selesai_kerja.after' => 'Jam selesai kerja harus setelah jam mulai kerja.',
            'hari_kerja.required' => 'Hari kerja harus diisi.',
            'hari_kerja.min' => 'Hari kerja minimal 1 hari.',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $kasir = Kasir::where('user_id', $user->id)->first();

            if (!$kasir) {
                $data['user_id'] = $user->id;
                Kasir::create($data);
            } else {
                $kasir->update($data);
            }

            DB::commit();

            return redirect()->route('profile.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateDataDokter(Request $request)
    {
        $user = Auth::user();
        $dokter = Dokter::where('user_id', $user->id)->first();

        $data = $request->validate([
            'nip' => 'required|string|max:30|unique:dokter,nip,' . ($dokter ? $dokter->id : ''),
            'nama' => 'required|string|max:50|unique:dokter,nama,' . ($dokter ? $dokter->id : ''),
            'poli_id' => 'required|exists:poli,id',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'jam_mulai_kerja' => 'required|date_format:H:i',
            'jam_selesai_kerja' => 'required|date_format:H:i|after:jam_mulai_kerja',
            'hari_kerja' => 'required|min:1',
        ], [
            'nip.required' => 'NIP harus diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama harus diisi.',
            'nama.unique' => 'Nama sudah terdaftar.',
            'poli_id.required' => 'Poli harus dipilih.',
            'poli_id.exists' => 'Poli yang dipilih tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'jam_mulai_kerja.required' => 'Jam mulai kerja harus diisi.',
            'jam_selesai_kerja.required' => 'Jam selesai kerja harus diisi.',
            'jam_selesai_kerja.after' => 'Jam selesai kerja harus setelah jam mulai kerja.',
            'hari_kerja.required' => 'Hari kerja harus diisi.',
            'hari_kerja.min' => 'Hari kerja minimal 1 hari.',
        ]);

        try {
            DB::beginTransaction();

            if (!$dokter) {
                $data['user_id'] = $user->id;
                $dokter = Dokter::create($data);
            } else {
                $dokter->update($data);
            }

            DB::commit();

            return redirect()->route('profile.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
