<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $fillable = [
        'user_id',
        'poli_id',
        'nip',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jam_mulai_kerja',
        'jam_selesai_kerja',
        'hari_kerja',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
