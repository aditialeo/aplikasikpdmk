<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table ='barang_keluar';
    protected $primarykey ='id';
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->hashMany(Barang::class,'kd_barang','nm_barang');
    }

    public function suplair()
    {
        return $this->belongsTo(Suplair::class, 'suplair_id','id');
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class,'merk_id', 'id');
    }


    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class,'jumlah_keluar',);
    }



}
