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
        Schema::create('surat_jalan_barang_keluar', function (Blueprint $table) {
             $table->id();
            $table->string('nomor_surat')->unique(); // contoh: SJ/2025/0001
            $table->unsignedBigInteger('barang_keluar_id'); // relasi ke barang_keluar
            $table->date('tanggal_surat');
            $table->string('nama_penerima');
            $table->string('nama_sales'); // input manual
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('barang_keluar_id')->references('id')->on('barang_keluar')->onDelete('cascade'); // lihat 
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_jalan_barang_keluar');
    }
};
