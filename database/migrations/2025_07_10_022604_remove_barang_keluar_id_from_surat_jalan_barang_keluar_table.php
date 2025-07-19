<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_jalan_barang_keluar', function (Blueprint $table) {
            // Drop foreign key dulu (kalau ada)
            if (Schema::hasColumn('surat_jalan_barang_keluar', 'barang_keluar_id')) {
                $table->dropForeign(['barang_keluar_id']);
                $table->dropColumn('barang_keluar_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('surat_jalan_barang_keluar', function (Blueprint $table) {
            $table->unsignedBigInteger('barang_keluar_id')->nullable();
            $table->foreign('barang_keluar_id')->references('id')->on('barang_keluar')->onDelete('cascade');
        });
    }
};
