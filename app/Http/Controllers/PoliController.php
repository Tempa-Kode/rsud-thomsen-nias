<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliController extends Controller
{
    public function index()
    {
        $poli = Poli::all();
        return view('poli.index', compact('poli'));
    }

    public function create()
    {
        return view('poli.tambah');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'nama_poli.required' => 'Nama Poli harus diisi.',
            'nama_poli.string' => 'Nama Poli harus berupa teks.',
            'nama_poli.max' => 'Nama Poli tidak boleh lebih dari 255 karakter.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 500 karakter.',
        ]);

        DB::beginTransaction();
        try {
            $poli = Poli::create($data);
            DB::commit();
            return redirect()->route('poli.index')->with('success', "{$poli->nama_poli} berhasil ditambahkan.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan Poli: ' . $e->getMessage()]);
        }
    }

    public function edit($poli)
    {
        $poli = Poli::findOrFail($poli);
        return view('poli.edit', compact('poli'));
    }

    public function update(Request $request, $poli)
    {
        $data = $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'nama_poli.required' => 'Nama Poli harus diisi.',
            'nama_poli.string' => 'Nama Poli harus berupa teks.',
            'nama_poli.max' => 'Nama Poli tidak boleh lebih dari 255 karakter.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 500 karakter.',
        ]);

        DB::beginTransaction();
        try {
            $poli = Poli::findOrFail($poli);
            $poli->update($data);
            DB::commit();
            return redirect()->route('poli.index')->with('success', "{$poli->nama_poli} berhasil diperbarui.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui Poli: ' . $e->getMessage()]);
        }
    }

    public function destroy(Poli $poli)
    {
        DB::beginTransaction();
        try {
            $poli->delete();
            DB::commit();
            return redirect()->route('poli.index')->with('success', "{$poli->nama_poli} berhasil dihapus.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus Poli: ' . $e->getMessage()]);
        }
    }
}
