<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table ='barang_masuk';
    protected $primarykey ='id';
    protected $guarded = ['id'];

//belum clear disini

    public function barang()
    {
        return $this->belongsTo(Barang
        ::class,'kd_barang','kd_barang');
    }

    public function suplair()
    {
        return $this->belongsTo(Suplair::class, 'suplair_id','id');
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class,'merk_id', 'id');
    }


    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class,'jumlah_masuk',);
    }


}
