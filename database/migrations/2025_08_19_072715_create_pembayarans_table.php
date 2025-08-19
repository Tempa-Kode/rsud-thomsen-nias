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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rawat_jalan_id')->constrained('rawat_jalan')->onDelete('cascade');
            $table->decimal('grand_total', 10, 2);
            $table->enum('satatus', ['lunas', 'belum_lunas'])->default('belum_lunas');
            $table->foreignId('kasir_id')->constrained('kasir')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
