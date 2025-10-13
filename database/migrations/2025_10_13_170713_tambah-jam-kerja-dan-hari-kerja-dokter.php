<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->time('jam_mulai_kerja')->nullable();
            $table->time('jam_selesai_kerja')->nullable();
            $table->text('hari_kerja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->dropColumn(['jam_mulai_kerja', 'jam_selesai_kerja', 'hari_kerja']);
        });
    }
};
