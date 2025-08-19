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
        Schema::table('riwayat_pemeriksaan', function (Blueprint $table) {
            $table->decimal('biaya_pemeriksaan', 10, 2)->after('diagnosa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_pemeriksaan', function (Blueprint $table) {
            $table->dropColumn('biaya_pemeriksaan');
        });
    }
};
