<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        return view('obat.index', compact('obat'));
    }

    public function create()
    {
        return view('obat.tambah');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_obat' => 'required|max:50|unique:obat,nama_obat',
            'jenis_obat' => 'required|max:50',
            'merk_obat' => 'required|max:50',
            'aturan_pakai' => 'required|max:100',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|max:20',
        ], [
            'nama_obat.required' => 'Nama obat harus diisi.',
            'nama_obat.max' => 'Nama obat maksimal 50 karakter.',
            'nama_obat.unique' => 'Nama obat sudah ada.',
            'jenis_obat.required' => 'Jenis obat harus diisi.',
            'jenis_obat.max' => 'Jenis obat maksimal 50 karakter.',
            'merk_obat.required' => 'Merk obat harus diisi.',
            'merk_obat.max' => 'Merk obat maksimal 50 karakter.',
            'aturan_pakai.required' => 'Aturan pakai harus diisi.',
            'aturan_pakai.max' => 'Aturan pakai maksimal 100 karakter.',
            'stok.required' => 'Stok harus diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan harus diisi.',
            'satuan.max' => 'Satuan maksimal 20 karakter.'
        ]);

        DB::beginTransaction();
        try {
            Obat::create($data);
            DB::commit();
            return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan obat: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $data = $request->validate([
            'nama_obat' => 'required|max:50|unique:obat,nama_obat,' . $obat->id,
            'jenis_obat' => 'required|max:50',
            'merk_obat' => 'required|max:50',
            'aturan_pakai' => 'required|max:100',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|max:20',
        ], [
            'nama_obat.required' => 'Nama obat harus diisi.',
            'nama_obat.max' => 'Nama obat maksimal 50 karakter.',
            'nama_obat.unique' => 'Nama obat sudah ada.',
            'jenis_obat.required' => 'Jenis obat harus diisi.',
            'jenis_obat.max' => 'Jenis obat maksimal 50 karakter.',
            'merk_obat.required' => 'Merk obat harus diisi.',
            'merk_obat.max' => 'Merk obat maksimal 50 karakter.',
            'aturan_pakai.required' => 'Aturan pakai harus diisi.',
            'aturan_pakai.max' => 'Aturan pakai maksimal 100 karakter.',
            'stok.required' => 'Stok harus diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'satuan.required' => 'Satuan harus diisi.',
            'satuan.max' => 'Satuan maksimal 20 karakter.'
        ]);

        DB::beginTransaction();
        try {
            $obat->update($data);
            DB::commit();
            return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui obat: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Obat $obat)
    {
        DB::beginTransaction();
        try {
            $obat->delete();
            DB::commit();
            return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus obat: ' . $e->getMessage()]);
        }
    }

    public function downloadPDF()
    {
        $obat = Obat::all();
        $pdf = PDF::loadView('obat.report', compact('obat'));
        return $pdf->stream('data_obat.pdf');
    }
}
