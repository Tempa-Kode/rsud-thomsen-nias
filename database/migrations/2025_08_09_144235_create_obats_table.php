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
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat', 50)->unique();
            $table->string('jenis_obat', 50);
            $table->string('merk_obat', 50);
            $table->string('aturan_pakai', 100);
            $table->integer('stok');
            $table->decimal('harga', 20, 2);
            $table->string('satuan', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
