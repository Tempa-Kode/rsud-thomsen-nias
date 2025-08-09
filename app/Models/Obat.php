<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';
    protected $fillable = [
        'nama_obat',
        'jenis_obat',
        'merk_obat',
        'aturan_pakai',
        'stok',
        'harga',
        'satuan'
    ];

    public $timestamps = false;

    public function getHargaFormattedAttribute()
    {
        return number_format($this->harga, 0, ',', '.');
    }
}
