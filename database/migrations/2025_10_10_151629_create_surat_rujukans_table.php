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
        Schema::create('surat_rujukan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokter')->onDelete('cascade');
            $table->foreignId('riwayat_pemeriksaan_id')->constrained('riwayat_pemeriksaan')->onDelete('cascade');
            $table->string('no_surat', 50)->nullable()->unique();
            $table->date('tgl_surat')->nullable();
            $table->string('tujuan', 100)->nullable();
            $table->string('alamat_tujuan', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_rujukan');
    }
};
