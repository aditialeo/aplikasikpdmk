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
    protected $casts = [
        'tanggal_keluar' => 'datetime',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class,'kd_barang','kd_barang');
    }

    // public function suplair()
    // {
        // return $this->belongsTo(Suplair::class, 'suplair_id','id');
    // }

    public function merk()
    {
        return $this->belongsTo(Merk::class,'merk_id', 'id');
    }

    public function suratJalan()
    {
    return $this->belongsTo(SuratJalanBarangKeluar::class, 'surat_jalan_id');
    }


}
