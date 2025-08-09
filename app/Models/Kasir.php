<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $table = 'kasir';

    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
