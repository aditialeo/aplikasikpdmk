<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplair extends Model
{
    use HasFactory;
    protected $table ='suplair';
    protected $primaryKey ='id';
    protected $guarded = ['id'];

    public function barangMasuk()
    {
        return $this->hasMany(Barang::class);
    }
}

