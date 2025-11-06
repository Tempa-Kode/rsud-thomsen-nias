<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\RawatJalan;
use App\Models\RiwayatPemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepObatController extends Controller
{
    public function index(Request $request)
    {
        $query = RawatJalan::with(['pasien', 'dokter', 'poli', 'resepObat.obat'])
            ->whereHas('resepObat')
            ->orderBy('tanggal_kunjungan', 'desc');

        // Filter berdasarkan role pengguna
        if (Auth::user()->role == 'pasien') {
            $query->where('pasien_id', Auth::user()->pasien->id);
            $query->whereHas('pembayaran', function ($q) {
                $q->where('status', 'lunas');
            });
        }

        $data = $query->get();

        return view('resep-obat.index', compact('data'));
    }

    public function show($id)
    {
        $rawatJalan = RawatJalan::with(['pasien', 'dokter', 'poli', 'riwayatPemeriksaan', 'resepObat.obat', 'pembayaran'])
            ->findOrFail($id);

        // Authorization check
        if (Auth::user()->role == 'pasien' && $rawatJalan->pasien_id != Auth::user()->pasien->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('resep-obat.show', compact('rawatJalan'));
    }

    public function updateStatusPengambilan($id)
    {
        $riwayatPemeriksaan = RiwayatPemeriksaan::where('id', $id)->first();
        $riwayatPemeriksaan->ambil_obat = true;
        $riwayatPemeriksaan->save();

        return redirect()->route('resep-obat.show', $riwayatPemeriksaan->rawat_jalan_id)
                         ->with('success', 'Status pengambilan obat berhasil diperbarui.');
    }
}
