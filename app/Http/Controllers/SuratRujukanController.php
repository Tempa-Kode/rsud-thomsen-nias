<?php

namespace App\Http\Controllers;

use App\Models\SuratRujukan;
use Illuminate\Http\Request;
use App\Models\RiwayatPemeriksaan;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratRujukanController extends Controller
{
    public function index()
    {
        $data = SuratRujukan::with(['pasien', 'dokter', 'riwayatPemeriksaan.rawatJalan.pasien'])->orderBy('id', 'desc')->get();
        return view('surat-rujukan.index', compact('data'));
    }

    public function buatRujukan($riwayatPemeriksaanId)
    {
        $pemeriksaan = RiwayatPemeriksaan::with(['rawatJalan.pasien', 'rawatJalan.dokter', 'rawatJalan.poli'])
            ->findOrFail($riwayatPemeriksaanId);
        return view('surat-rujukan.form', compact('pemeriksaan'));
    }

    public function simpanRujukan(Request $request)
    {
        $data = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'riwayat_pemeriksaan_id' => 'required|exists:riwayat_pemeriksaan,id',
            'tujuan' => 'required|string',
            'alamat_tujuan' => 'required|string',
        ], [
            'pasien_id.required' => 'Pasien wajib diisi',
            'pasien_id.exists' => 'Pasien tidak valid',
            'dokter_id.required' => 'Dokter wajib diisi',
            'dokter_id.exists' => 'Dokter tidak valid',
            'riwayat_pemeriksaan_id.required' => 'Riwayat pemeriksaan wajib diisi',
            'riwayat_pemeriksaan_id.exists' => 'Riwayat pemeriksaan tidak valid',
            'tujuan.required' => 'Tujuan rujukan wajib diisi',
            'alamat_tujuan.required' => 'Alamat tujuan rujukan wajib diisi',
        ]);

        try {
            SuratRujukan::create($data);
            return redirect()->route('riwayat-pemeriksaan.show', $data['riwayat_pemeriksaan_id'])->with('success', 'Surat rujukan berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal membuat surat rujukan: ' . $e->getMessage()])->withInput();
        }
    }

    public function terbitkanRujukan($id)
    {
        $suratRujukan = SuratRujukan::with(['pasien', 'dokter', 'riwayatPemeriksaan.rawatJalan.pasien'])->findOrFail($id);
        return view('surat-rujukan.terbit', compact('suratRujukan'));
    }

    public function simpanTerbitan(Request $request, $id)
    {
        $suratRujukan = SuratRujukan::findOrFail($id);

        $data = $request->validate([
            'no_surat' => 'required|string',
            'tgl_surat' => 'required|string',
        ], [
            'no_surat.required' => 'Nomor surat wajib diisi',
            'tgl_surat.required' => 'Tanggal surat wajib diisi',
        ]);

        try {
            $suratRujukan->update($data);
            return redirect()->route('surat-rujukan.index')->with('success', 'Surat rujukan berhasil diterbitkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui surat rujukan: ' . $e->getMessage()])->withInput();
        }
    }

    public function cetakRujukan($id)
    {
        $suratRujukan = SuratRujukan::with(['pasien', 'dokter', 'riwayatPemeriksaan.rawatJalan.pasien'])->findOrFail($id);

        $data = ['suratRujukan' => $suratRujukan];

        $pdf = Pdf::loadView('surat-rujukan.cetak', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->stream("Surat_Rujukan_{$suratRujukan->riwayatPemeriksaan->rawatJalan->pasien->nama}.pdf");
    }
}
