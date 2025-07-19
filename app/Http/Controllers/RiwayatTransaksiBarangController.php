<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\JenisBarang;
use App\Models\Merk;
use App\Models\RiwayatTransaksiBarang;
use App\Models\Suplair;
use Illuminate\Http\Request;

class RiwayatTransaksiBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $riwayattransaksibarang = RiwayatTransaksiBarang::latest()->get(); // latest untuk urut data yang terbaru ke lama
        return view('riwayattransaksibarang.index',compact('riwayattransaksibarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $barangs = Barang::all();
    //     $suplairs = Suplair::all();
    //     $merks = Merk::all();
    //     $jenisbarangs = JenisBarang::all();

    //     return view('riwayattransaksibarang.create',compact('barangs','suplairs','merks','jenisbarangs'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_barang' => 'required',
    //         'kd_barang' => 'required',
    //         'barang_masuk' => 'required',
    //         'jenis_barang_id' => 'required',
    //         'suplair_id'=>'required',
    //         'merk_id' =>'required',
    //         'jumlah_masuk'=>'required',
    //         'jenis'=>'required'
    //     ]);

    //     RiwayatTransaksiBarang::create($request->all());

    //     return to_route('riwayattransaksibarang.index');

    // }

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
        $riwayat = RiwayatTransaksiBarang::find($id);
        $riwayat->delete();
        return to_route('riwayattransaksibarang.index');
    }
}
