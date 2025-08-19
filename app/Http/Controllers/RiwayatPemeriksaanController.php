<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\RawatJalan;
use App\Models\ResepObat;
use Illuminate\Http\Request;
use App\Models\RiwayatPemeriksaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatPemeriksaanController extends Controller
{
    public function index(Request $request)
    {
        $bpjs = $request->has('bpjs')
            ? filter_var($request->query('bpjs'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
            : null;

        $query = RiwayatPemeriksaan::with('rawatJalan.pasien', 'rawatJalan.dokter', 'rawatJalan.poli')
            ->join('rawat_jalan', 'riwayat_pemeriksaan.rawat_jalan_id', '=', 'rawat_jalan.id')
            ->select('riwayat_pemeriksaan.*')
            ->orderBy('rawat_jalan.tanggal_kunjungan', 'desc')
            ->bpjs($bpjs);

        if (Auth::user()->role == 'pasien') {
            $query->whereHas('rawatJalan', function ($q) {
                $q->where('pasien_id', Auth::user()->pasien->id);
            });
        }

        $data = $query->get();

        return view('riwayat-pemeriksaan.index', compact('data'));
    }

    public function periksa($id)
    {
        $data = RawatJalan::where('id', $id)->with('poli', 'pasien', 'dokter')->first();
        $data->update(['status' => 'dalam_perawatan']);
        $obat = Obat::all();
        return view('riwayat-pemeriksaan.periksa', compact('data', 'obat'));
    }

    public function simpanPemeriksaan(Request $request, $id)
    {
        $validasi = $request->validate([
            'rawat_jalan_id' => 'required|exists:rawat_jalan,id',
            'penyakit' => 'required|string|max:255',
            'diagnosa' => 'required|string|max:255',
            'biaya_pemeriksaan' => 'required|numeric|min:0',
            'obat.*' => 'required|exists:obat,id',
            'jumlah.*' => 'required|numeric|min:1',
            'keterangan.*' => 'nullable|string|max:255',
        ], [
            'rawat_jalan_id.required' => 'Rawat jalan ID harus diisi.',
            'rawat_jalan_id.exists' => 'Rawat jalan ID tidak valid.',
            'diagnosa.required' => 'Diagnosa harus diisi.',
            'diagnosa.string' => 'Diagnosa harus berupa teks.',
            'diagnosa.max' => 'Diagnosa maksimal 255 karakter.',
            'penyakit.required' => 'Penyakit harus diisi.',
            'penyakit.string' => 'Penyakit harus berupa teks.',
            'penyakit.max' => 'Penyakit maksimal 255 karakter.',
            'biaya_pemeriksaan.required' => 'Biaya pemeriksaan harus diisi.',
            'biaya_pemeriksaan.numeric' => 'Biaya pemeriksaan harus berupa angka.',
            'biaya_pemeriksaan.min' => 'Biaya pemeriksaan minimal 0.',
            'obat.*.required' => 'Obat harus dipilih.',
            'obat.*.exists' => 'Obat tidak valid.',
            'jumlah.*.required' => 'Jumlah harus diisi.',
            'jumlah.*.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.*.min' => 'Jumlah minimal 1.',
            'keterangan.*.nullable' => 'Keterangan boleh kosong.',
            'keterangan.*.string' => 'Keterangan harus berupa teks.',
            'keterangan.*.max' => 'Keterangan maksimal 255 karakter.',
        ]);

        DB::beginTransaction();
        try{
            $riwayatPemeriksaan = RiwayatPemeriksaan::create([
                'rawat_jalan_id' => $validasi['rawat_jalan_id'],
                'penyakit' => $validasi['penyakit'],
                'diagnosa' => $validasi['diagnosa'],
                'biaya_pemeriksaan' => $validasi['biaya_pemeriksaan'],
            ]);
            foreach ($validasi['obat'] as $index => $obatId) {
                ResepObat::create([
                    'rawat_jalan_id' => $validasi['rawat_jalan_id'],
                    'obat_id' => $obatId,
                    'jumlah' => $validasi['jumlah'][$index],
                    'keterangan' => $validasi['keterangan'][$index] ?? null,
                ]);
            }
            RawatJalan::where('id', $validasi['rawat_jalan_id'])
                ->update(['dokter_id' => Auth::user()->dokter->id, 'status' => 'selesai']);
            DB::commit();
            return redirect()->route('riwayat-pemeriksaan.index')->with('success', 'Data pemeriksaan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => "Terjadi kesalahan saat menyimpan data. {$e->getMessage()}"]);
        }
    }

    public function edit($id)
    {
        $pemeriksaan = RiwayatPemeriksaan::with(['rawatJalan.pasien', 'rawatJalan.dokter', 'rawatJalan.poli'])
            ->findOrFail($id);
        $obat = Obat::all();

        // Ambil resep-obat lama berdasarkan rawat_jalan_id untuk ditampilkan
        $resep = \App\Models\ResepObat::where('rawat_jalan_id', $pemeriksaan->rawat_jalan_id)->get();

        return view('riwayat-pemeriksaan.edit', compact('pemeriksaan', 'obat', 'resep'));
    }

    public function update(Request $request, $id)
    {
        $pemeriksaan = RiwayatPemeriksaan::findOrFail($id);

        $validasi = $request->validate([
            'penyakit' => 'required|string|max:255',
            'diagnosa' => 'required|string|max:255',
            'biaya_pemeriksaan' => 'required|numeric|min:0',
            'obat.*' => 'required|exists:obat,id',
            'jumlah.*' => 'required|numeric|min:1',
            'keterangan.*' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $pemeriksaan->update([
                'penyakit' => $validasi['penyakit'],
                'diagnosa' => $validasi['diagnosa'],
                'biaya_pemeriksaan' => $validasi['biaya_pemeriksaan'],
            ]);

            // Reset resep obat lama dan simpan ulang sederhana
            ResepObat::where('rawat_jalan_id', $pemeriksaan->rawat_jalan_id)->delete();
            foreach ($request->input('obat', []) as $idx => $obatId) {
                ResepObat::create([
                    'rawat_jalan_id' => $pemeriksaan->rawat_jalan_id,
                    'obat_id' => $obatId,
                    'jumlah' => $request->input("jumlah.$idx"),
                    'keterangan' => $request->input("keterangan.$idx"),
                ]);
            }

            DB::commit();
            return redirect()->route('riwayat-pemeriksaan.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => "Gagal memperbarui data. {$e->getMessage()}"])->withInput();
        }
    }

    public function show($id)
    {
        $pemeriksaan = RiwayatPemeriksaan::with(['rawatJalan.pasien', 'rawatJalan.dokter', 'rawatJalan.poli'])
            ->findOrFail($id);
        $resep = ResepObat::where('rawat_jalan_id', $pemeriksaan->rawat_jalan_id)
            ->with('obat')
            ->get();

        return view('riwayat-pemeriksaan.show', compact('pemeriksaan', 'resep'));
    }
}
