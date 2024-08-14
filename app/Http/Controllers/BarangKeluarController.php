<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\JenisBarang;
use App\Models\Merk;
use App\Models\RiwayatTransaksiBarang;
use App\Models\Suplair;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangkeluar = BarangKeluar::all();
        return view('barangkeluar.index', compact('barangkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
        $suplairs = Suplair::all();
        $merks = Merk::all();
        return view('barangkeluar.create', compact('barangs', 'suplairs', 'merks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        $barangKeluar = BarangKeluar::create($request->validated());

        if ($barangKeluar) {

            $request->request->add(['jenis' => 'barang_keluar'],);
            $request->request->add(['stok' => $request->jumlah_keluar]);

            // Membuat riwayat transaksi barang
            $riwayat_barang = RiwayatTransaksiBarang::create($request->all());
            $barang = Barang::where(
                'kd_barang',
                $request->kd_barang
            )->decrement('stok', $request->jumlah_keluar);
        }

        return redirect()->route('barangkeluar.index')->with('success', 'Berhasil menambahkan barang keluar');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = BarangKeluar::find($id);
        $barangs = Barang::all();
        $suplairs = Suplair::all();
        $merks = Merk::all();
        return view('barangkeluar.edit', compact('data', 'barangs', 'suplairs', 'merks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kd_barang' => 'required',
            'jumlah_keluar' => 'required',
            'tanggal_keluar' => 'required',
            'merk_id' => 'required',
            'suplair_id' => 'required',
        ]);

        //search barang keluar kemudian update stok barang berdasarkan stok barang keluar sebelumnya kemudian update barang keluar dengan stok baru kemudian update stok barang, stok barang keluar tidak boleh lebih besar dari stok barang
        $barangKeluar = BarangKeluar::find($id);
        $barang = Barang::where('kd_barang', $barangKeluar->kd_barang)->first();
        if ($request->jumlah_keluar > ($barang->stok + $barangKeluar->jumlah_keluar)) {
            return redirect()->route('barangkeluar.index')->with('error', 'Jumlah barang keluar tidak boleh lebih besar dari stok barang');
        } else {
            //update request jumlah_keluar
            $barang->update(['stok' => $barang->stok + $barangKeluar->jumlah_keluar]);
            $barang = Barang::where('kd_barang', $request->kd_barang)->decrement('stok', $request->jumlah_keluar);
            $barangKeluar->update($request->all());
            return redirect()->route('barangkeluar.index')->with('success', 'Berhasil mengubah barang keluar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //search barang keluar kemudian update jumlah barang baru kemudian hapus barang keluar
        $barangKeluar = BarangKeluar::find($id);
        $barang = Barang::where('kd_barang', $barangKeluar->kd_barang)->increment('stok', $barangKeluar->jumlah_keluar);
        $barangKeluar->delete();

        return redirect()->route('barangkeluar.index')->with('success', 'Berhasil menghapus barang keluar');
    }
}
