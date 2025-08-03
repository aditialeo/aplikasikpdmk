<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalanBarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_jalan_barang_keluar';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    // Relasi satu surat jalan bisa punya banyak barang keluar

    public function barangKeluars()
    {
        return $this->belongsToMany(Barang::class, 'barang_keluar', 'surat_jalan_id', 'kd_barang', 'id', 'kd_barang')->withPivot(['merk_id', 'jumlah_keluar', 'nama_customer']); // jika pakai timestamps di pivot
    }


    // Jika tetap ingin akses satu barang (opsional, jika tidak pakai relasi langsung bisa dihapus)
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    // Akses ke merek jika suatu saat perlu
    public function merk()
    {
        return $this->belongsTo(Merk::class, 'merk_id');
    }

    // Relasi ke user/admin yang buat surat jalan
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
