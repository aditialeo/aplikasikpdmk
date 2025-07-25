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
            $table->date('tanggal_masuk')->after('jumlah_masuk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
        {
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->dropColumn('tanggal_masuk');
        });
    }
};
