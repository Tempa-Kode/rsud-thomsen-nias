<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    protected $table = 'resep_obat';
    public $timestamps = false;

    protected $fillable = [
        'rawat_jalan_id',
        'obat_id',
        'jumlah',
        'keterangan',
    ];

    public function rawatJalan()
    {
        return $this->belongsTo(RawatJalan::class, 'rawat_jalan_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
