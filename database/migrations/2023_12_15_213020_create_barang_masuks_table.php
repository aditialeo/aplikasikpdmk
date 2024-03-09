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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->text('nama_barang');
            $table->integer('kd_barang');
            $table->foreign('kd_barang')->references('kd_barang')->on('barang');
            $table->unsignedBigInteger('jenis_brg');
            $table->unsignedBigInteger('Suplair_id');
            $table->unsignedBigInteger('merk');
            $table->integer('jumlah_masuk');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
