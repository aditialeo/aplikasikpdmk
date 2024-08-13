<?php

namespace App\Observers;

use App\Models\BarangMasuk;
use Illuminate\Http\Client\Request;
use App\Models\RiwayatTransaksiBarang;
use App\Models\Barang;

class BarangMasukObserver
{
    /**
     * Handle the BarangMasuk "created" event.
     */
    public function created(BarangMasuk $barangMasuk): void
    {
        if ($barangMasuk) {
            request()->request->add(['jenis'=>'barang_masuk']);
            request()->request->add(['stok'=>request()->jumlah_masuk]);

            $riwayat_barang = RiwayatTransaksiBarang::create(request()->all());
            $barang = Barang::where('kd_barang',
            request()->kd_barang)->increment('stok',request()->jumlah_masuk);
        }
    }

    /**
     * Handle the BarangMasuk "updated" event.
     */
    public function updated(BarangMasuk $barangMasuk): void
    {
        //
    }

    /**
     * Handle the BarangMasuk "deleted" event.
     */
    public function deleted(BarangMasuk $barangMasuk): void
    {
        //when barang masuk deleted update stok in table barang
        $barang = Barang::where('kd_barang',$barangMasuk->kd_barang)->decrement('stok',$barangMasuk->jumlah_masuk);
    }

    /**
     * Handle the BarangMasuk "restored" event.
     */
    public function restored(BarangMasuk $barangMasuk): void
    {
        //
    }

    /**
     * Handle the BarangMasuk "force deleted" event.
     */
    public function forceDeleted(BarangMasuk $barangMasuk): void
    {
        //
    }
}
