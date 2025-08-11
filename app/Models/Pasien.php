<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'user_id',
        'no_bpjs',
        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'tinggi_badan',
        'berat_badan',
        'no_hp',
        'agama',
        'pekerjaan'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
