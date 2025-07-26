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
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->string('nomor_surat_jalan')->nullable();  // Kolom untuk nomor surat jalan
            $table->string('nama_kapal')->nullable();         // Kolom untuk nama kapal
            $table->string('nomor_container')->nullable();    // Kolom untuk nomor container
            $table->date('tanggal_keberangkatan')->nullable(); // Kolom untuk tanggal keberangkatan

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_masuk', function (Blueprint $table) {
          $table->dropColumn(['nomor_surat_jalan', 'nama_kapal', 'nomor_container', 'tanggal_keberangkatan']);
        });
    }
};
