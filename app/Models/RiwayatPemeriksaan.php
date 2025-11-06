<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPemeriksaan extends Model
{
    protected $table = 'riwayat_pemeriksaan';
    protected $fillable = [
        'rawat_jalan_id',
        'penyakit',
        'diagnosa',
        'biaya_pemeriksaan',
        'ambil_obat',
    ];
    public $timestamps = false;

    public function rawatJalan()
    {
        return $this->belongsTo(RawatJalan::class, 'rawat_jalan_id');
    }

    public function scopeBpjs($query, $bpjs = null)
    {
        // anggap '', 'null' juga sebagai null (tampilkan semua data)
        if ($bpjs === null || $bpjs === '' || $bpjs === 'null') {
            return $query;
        }

        $value = in_array($bpjs, [1, '1', true, 'true'], true) ? 1 : 0;

        return $query->whereHas('rawatJalan', function ($q) use ($value) {
            $q->where('bpjs', $value);
        });
    }
}
