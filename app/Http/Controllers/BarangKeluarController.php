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
        return view('barangkeluar.index',compact('barangkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs= Barang::all();
        $suplairs= Suplair::all();
        $merks= Merk::all();
        return view('barangkeluar.create',compact('barangs','suplairs','merks'));
    }

// api ambil nama barang keluar

public function getNamaBarang(Request $request)
{
    $data['data'] = Barang::where('kd_barang',$request->kd_barang)->first();
    return response()->json($data);
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        $barangKeluar= BarangKeluar::create($request->validated());

        if ($barangKeluar) {

            $request->request->add(['jenis'=>'barang_keluar'],);
            $request->request->add(['stok'=>$request->jumlah_keluar]);

            // Membuat riwayat transaksi barang
            $riwayat_barang = RiwayatTransaksiBarang::create($request->all());
            $barang = Barang::where('kd_barang',
            $request->kd_barang)->decrement('stok',$request->jumlah_keluar);
        }
      return to_route('barangkeluar.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
