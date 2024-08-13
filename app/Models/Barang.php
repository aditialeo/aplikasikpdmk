<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table ='barang';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    // protected $fillable = ['kd_barang'];

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id', 'id');
    }

    public function barangMasuk()

    {
        return $this->hasMany(BarangMasuk::class,'kd_barang', 'kd_barang');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class,'kd_barang', 'kd_barang');
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class,'merk_id', 'id');
    }

    public function satuanBarang()
    {
        return $this->belongsTo(SatuanBarang::class);
    }


    }


