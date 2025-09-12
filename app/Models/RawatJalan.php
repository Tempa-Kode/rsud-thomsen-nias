<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawatJalan extends Model
{
    protected $table = 'rawat_jalan';

    protected $fillable = [
        'nomor_rekam_medik',
        'pasien_id',
        'poli_id',
        'dokter_id',
        'deskripsi_keluhan',
        'bpjs',
        'tanggal_kunjungan',
        'status',
        'nomor_antrian'
    ];

    public $timestamps = false;

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function riwayatPemeriksaan()
    {
        return $this->hasOne(RiwayatPemeriksaan::class);
    }

    public function resepObat()
    {
        return $this->hasMany(ResepObat::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function scopeBpjs($query, $bpjs)
    {
        return $query->where('bpjs', $bpjs);
    }
}
