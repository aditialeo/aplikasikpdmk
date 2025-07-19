<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksiBarang extends Model
{
    use HasFactory;
    protected $table ='riwayat_transaksi_barang';
    protected $primarykey ='id';
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class,'kd_barang','kd_barang');
    }


    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class,'kd_barang','kd_barang');
    }

    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class,'kd_barang','kd_barang');
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class);
    }

    public function suplair()
    {
        return $this->belongsTo(Suplair::class);
    }



}
