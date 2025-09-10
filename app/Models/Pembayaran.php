<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    public $timestamps = false;

    protected $fillable = [
        'rawat_jalan_id',
        'grand_total',
        'satatus',
        'kasir_id',
    ];

    public function rawatJalan()
    {
        return $this->belongsTo(RawatJalan::class, 'rawat_jalan_id');
    }

    public function kasir()
    {
        return $this->belongsTo(Kasir::class, 'kasir_id');
    }
}
