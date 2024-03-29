<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\JenisBarang;
use App\Models\Merk;
use App\Models\SatuanBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $merks = Merk::latest()->get();
        $merks = Merk::all();
        $jenisBarangs = JenisBarang::all();
        $satuanBarangs = SatuanBarang::all();
        return view('barang.create',compact('merks','jenisBarangs','satuanBarangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_barang' => 'required',
            'nm_barang' => 'required|string',
            'satuan_barang_id' => 'required',
            'jenis_barang_id' => 'required',
            'stok' => 'required',
            'merk_id' => 'required',
        ]);

        Barang::create($request->all());

        return to_route('barang.index');
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
        $barang = Barang::find($id);
        $merks = Merk::all();
        $jenisBarangs = JenisBarang::all();
        $satuanBarangs = SatuanBarang::all();
        return view('barang.edit',compact('barang' ,'merks', 'jenisBarangs','satuanBarangs'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kd_barang' => 'required',
            'nm_barang' => 'required|string',
            'satuan_barang_id' => 'required',
            'jenis_barang_id' => 'required',
            'stok' => 'required',
            'merk_id' => 'required',
        ]);
        $barang = Barang::find($id);

        $barang->update([
           'kd_barang'=>$request->kd_barang,
           'nm_barang'=>$request->nm_barang,
           'satuan_barang-id'=>$request->satuan_barang_id,
           'jenis_barang-id'=>$request->jenis_barang_id,
           'stok'=>$request->stok,
           'merk_id'=>$request->merk_id,
        ]);
        return to_route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Barang::destroy($id);
        return to_route('barang.index');
    }
}
