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
        Schema::table('rawat_jalan', function (Blueprint $table) {
            $table->enum('status', ['validasi','menunggu','dalam_perawatan','selesai'])->default('validasi')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rawat_jalan', function (Blueprint $table) {
            $table->enum('status', ['menunggu','dalam_perawatan','selesai'])->default('validasi')->change();
        });
    }
};
