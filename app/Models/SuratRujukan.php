<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratRujukan extends Model
{
    protected $table = 'surat_rujukan';
    public $timestamps = false;
    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'riwayat_pemeriksaan_id',
        'no_surat',
        'tgl_surat',
        'tujuan',
        'alamat_tujuan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
    
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
    
    public function riwayatPemeriksaan()
    {
        return $this->belongsTo(RiwayatPemeriksaan::class, 'riwayat_pemeriksaan_id');
    }
}
