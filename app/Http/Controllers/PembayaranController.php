<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $query = Pembayaran::with(['rawatJalan', 'rawatJalan.pasien', 'rawatJalan.dokter', 'rawatJalan.poli', 'kasir']);
        if(Auth::user()->role == 'pasien'){
            $query->whereHas('rawatJalan', function($q){
                $q->where('pasien_id', Auth::user()->pasien->id);
                $q->orderBy('tanggal_kunjungan', 'desc');
            });
        }
        $data = $query->get();
        return view('pembayaran.index', compact('data'));
    }

    public static function tambah($data)
    {
        try{
            $pembayaran = Pembayaran::create($data);
            return $pembayaran;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function update($id, $data)
    {
        try{
            $pembayaran = Pembayaran::find($id);
            if(!$pembayaran){
                return 'Data pembayaran tidak ditemukan';
            }
            $pembayaran->update($data);
            return $pembayaran;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function bayar($id)
    {
        $pembayaran = Pembayaran::find($id);
        if(!$pembayaran){
            return response()->json(['message' => 'Data pembayaran tidak ditemukan'], 404);
        } else if ($pembayaran->status === 'lunas'){
            return response()->json(['message' => 'Pembayaran sudah lunas'], 400);
        }
        $pembayaran->status = 'lunas';
        $pembayaran->kasir_id = Auth::user()->kasir->id;
        $pembayaran->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Pembayaran berhasil dilakukan'
        ], 200);
    }
}
