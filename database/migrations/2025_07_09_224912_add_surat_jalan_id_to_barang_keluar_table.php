<?php

// database/migrations/xxxx_add_surat_jalan_id_to_barang_keluar_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->unsignedBigInteger('surat_jalan_id')->nullable()->after('id');

            // Tambahkan foreign key (optional)
            $table->foreign('surat_jalan_id')->references('id')->on('surat_jalan_barang_keluar')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->dropForeign(['surat_jalan_id']);
            $table->dropColumn('surat_jalan_id');
        });
    }
};
