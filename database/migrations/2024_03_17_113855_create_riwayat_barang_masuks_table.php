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
        Schema::create('riwayat_transaksi_barang', function (Blueprint $table) {
            $table->id();
            $table->text('nama_barang');
            $table->integer('kd_barang');
            $table->unsignedBigInteger('barang_masuk_id');
            $table->unsignedBigInteger('jenis_brg')->nullable();
            $table->unsignedBigInteger('Suplair_id');
            $table->unsignedBigInteger('merk_id');
            $table->integer('jumlah_masuk')->nullable();
            $table->enum('jenis',['barang_masuk','barang_keluar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_barang_masuk');
    }
};
