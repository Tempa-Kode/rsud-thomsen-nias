<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@pratamanisbar.go.id',
            'password' => bcrypt('superadmin'),
            'role' => 'superadmin',
        ]);

        User::create([
            'username' => 'pimpinan',
            'email' => 'pimpinan@pratamanisbar.go.id',
            'password' => bcrypt('pimpinan'),
            'role' => 'pimpinan',
        ]);

        User::create([
            'username' => 'kasir',
            'email' => 'kasir@pratamanisbar.go.id',
            'password' => bcrypt('kasir'),
            'role' => 'kasir',
        ]);

        User::create([
            'username' => 'dokter',
            'email' => 'dokter@pratamanisbar.go.id',
            'password' => bcrypt('dokter'),
            'role' => 'dokter',
        ]);

        User::create([
            'username' => 'pasien',
            'email' => 'pasien@pratamanisbar.go.id',
            'password' => bcrypt('pasien'),
            'role' => 'pasien',
        ]);
    }
}
