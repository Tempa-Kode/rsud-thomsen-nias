<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\RawatJalan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class RawatJalanController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', RawatJalan::class);
        $isBpjs = $request->query('bpjs') ?? true;
        if(Auth::user()->role == 'pasien'){
            $rawatJalan = RawatJalan::where('pasien_id', Auth::user()->pasien->id)
                ->bpjs($isBpjs)
                ->with('dokter', 'pasien', 'poli')
                ->orderBy('id', 'desc')
                ->get();
            return view('rawat-jalan.index', compact('rawatJalan'));
        } elseif (Auth::user()->role == 'dokter'){
            $rawatJalan = RawatJalan::where('poli_id', Auth::user()->dokter->poli->id)
                ->bpjs($isBpjs)
                ->with('dokter', 'pasien', 'poli')
                ->orderBy('id', 'desc')
                ->get();
            return view('rawat-jalan.index', compact('rawatJalan'));
        }
        $rawatJalan = RawatJalan::bpjs($isBpjs)->orderBy('id', 'desc')->get();
        return view('rawat-jalan.index', compact('rawatJalan'));
    }

    public function  pilihPendaftaran()
    {
        return view('rawat-jalan.pilih-pendaftaran');
    }

    public function halamanPendaftaran(Request $request)
    {
        if (isEmpty(Auth::user()->pasien->bpjs) && $request->query('bpjs') == 1) {
            return redirect()->back()->withErrors(['error' => 'Anda harus melengkapi data BPJS terlebih dahulu.']);
        }
        $poli = Poli::all();
        $dokter = Dokter::all();
        return view('rawat-jalan.halaman-pendaftaran', compact('poli', 'dokter'));
    }

    public function daftar(Request $request)
    {
        $validasi = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'poli_id' => 'required|exists:poli,id',
            'dokter_id' => 'nullable|exists:dokter,id',
            'deskripsi_keluhan' => 'nullable',
            'bpjs' => 'required|boolean',
            'tanggal_kunjungan' => 'required|date',
        ], [
            'pasien_id.required' => 'Pasien harus dipilih.',
            'pasien_id.exists' => 'Pasien tidak ditemukan.',
            'poli_id.required' => 'Poli harus dipilih.',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan harus diisi.',
        ]);

        DB::beginTransaction();
        try {
            $hariIni = $validasi['tanggal_kunjungan'];
            $antrianTerakhir = RawatJalan::where('poli_id', $validasi['poli_id'])
                ->whereDate('tanggal_kunjungan', $hariIni)
                ->orderByDesc('nomor_antrian')
                ->value('nomor_antrian');
            $validasi['nomor_antrian'] = $antrianTerakhir ? $antrianTerakhir + 1 : 1;
            $validasi['status'] = 'menunggu';
            RawatJalan::create($validasi);
            DB::commit();
            return redirect()->route('rawat-jalan.index')->with('success', "Pendaftaran berhasil dilakukan, nomor antrian Anda adalah {$validasi['nomor_antrian']}.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'gagal melakukan pendaftaran, silahkan coba lagi.']);
        }
    }
}
