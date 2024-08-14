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
        Schema::create('titip_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id');
            $table->string('jumlah_barang')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->string('alamat_pemilik')->nullable();
            $table->string('no_hp_pemilik')->nullable();
            $table->date('tanggal_titip')->nullable();
            $table->date('tanggal_ambil')->nullable();
            $table->string('status');
            $table->date('batas_waktu_titip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titip_barang');
    }
};
