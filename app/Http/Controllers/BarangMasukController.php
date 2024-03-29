<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Merk;
use App\Models\Suplair;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangmasuk = BarangMasuk::all();
        return view('barangmasuk.index',compact('barangmasuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $merks = Merk::all();
        $barangs = Barang::all();
        $suplairs = Suplair::all();
        return view('barangmasuk.create',compact('barangs','suplairs','merks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kd_barang' => 'required',
            'suplair_id' => 'required',
            'jumlah_masuk' => 'required',
            'merk_id' =>'required'
        ]);

        // dd($request->all());
       $barangMasuk = BarangMasuk::create($request->all());
        if ($barangMasuk) {
            $barang = Barang::where('kd_barang',$request->kd_barang)->increment('stok',$request->jumlah_masuk);
        }
        return to_route('barangmasuk.index');
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
    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('barang.edit',compact('barang'));

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
