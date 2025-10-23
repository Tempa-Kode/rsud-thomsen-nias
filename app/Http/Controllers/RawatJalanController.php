<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\RawatJalan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class RawatJalanController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', RawatJalan::class);
        $isBpjs = $request->query('bpjs') ?? true;
        $queryPoli = $request->query('poli') ?? null;
        if(Auth::user()->role == 'pasien'){
            $rawatJalan = RawatJalan::where('pasien_id', Auth::user()->pasien->id)
                ->bpjs($isBpjs)
                // ->poli($queryPoli)
                ->with('dokter', 'pasien', 'poli')
                ->orderBy('id', 'desc')
                ->get();
            return view('rawat-jalan.index', compact('rawatJalan'));
        } elseif (Auth::user()->role == 'dokter'){
            $rawatJalan = RawatJalan::where('poli_id', Auth::user()->dokter->poli->id)
                ->bpjs($isBpjs)
                // ->poli($queryPoli)
                ->with('dokter', 'pasien', 'poli')
                ->orderBy('id', 'desc')
                ->get();
            return view('rawat-jalan.index', compact('rawatJalan'));
        }
        $rawatJalan = RawatJalan::bpjs($isBpjs)->orderBy('id', 'desc')->get();
        $poli = Poli::all();
        return view('rawat-jalan.index', compact('rawatJalan', 'poli'));
    }

    public function  pilihPendaftaran()
    {
        return view('rawat-jalan.pilih-pendaftaran');
    }

    public function halamanPendaftaran(Request $request)
    {
        if (!Auth::user()->pasien->no_bpjs && $request->query('bpjs') == 1) {
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

    public function downloadReport(Request $request)
    {
        $validasi = $request->validate([
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date',
            'poli_id' => 'nullable',
        ], [
            'periode_awal.required' => 'Periode awal harus diisi.',
            'periode_akhir.required' => 'Periode akhir harus diisi.',
        ]);

        try {
            $data = RawatJalan::whereBetween('tanggal_kunjungan', [$validasi['periode_awal'], $validasi['periode_akhir']])
                ->when($request->filled('poli_id'), function ($query) use ($validasi) {
                    $query->where('poli_id', $validasi['poli_id']);
                })
                ->with('dokter', 'pasien', 'poli', 'riwayatPemeriksaan', 'pembayaran')
                ->orderBy('tanggal_kunjungan', 'asc')
                ->get();

            if ($data->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data pada periode yang dipilih.');
            }

            $poli = $data->first()->poli->nama_poli ?? 'Semua Poli';

            $periode = date('d M Y', strtotime($validasi['periode_awal'])) . ' - ' . date('d M Y', strtotime($validasi['periode_akhir']));

            $pdf = PDF::loadView('rawat-jalan.report', compact('data', 'poli', 'periode'));
            return $pdf->stream('data-rawatjalan.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengunduh laporan: ' . $e->getMessage());
        }
    }
}
