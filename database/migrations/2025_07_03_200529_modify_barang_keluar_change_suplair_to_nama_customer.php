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
        Schema::table('barang_keluar', function (Blueprint $table) {
            // Cukup rename kolom saja karena FK-nya tidak ada
            if (Schema::hasColumn('barang_keluar', 'suplair_id')) {
                $table->renameColumn('suplair_id', 'nama_customer');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->renameColumn('nama_customer', 'suplair_id');
            $table->foreign('suplair_id')->references('id')->on('suplair');
        });
    }
};
