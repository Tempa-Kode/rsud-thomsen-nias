<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $fillable = ['nama_poli', 'keterangan'];
    public $timestamps = false;

    public function dokter()
    {
        return $this->hasMany(Dokter::class);
    }

}
