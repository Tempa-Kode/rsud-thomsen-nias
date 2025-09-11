<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\RawatJalan;
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
        $rawatJalan = RawatJalan::with(['pasien', 'dokter', 'poli', 'riwayatPemeriksaan', 'resepObat.obat'])
            ->findOrFail($id);

        // Authorization check
        if (Auth::user()->role == 'pasien' && $rawatJalan->pasien_id != Auth::user()->pasien->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('resep-obat.show', compact('rawatJalan'));
    }
}
