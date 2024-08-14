<?php

namespace App\Http\Controllers;

use App\Models\SatuanBarang;
use Illuminate\Http\Request;
use Monolog\Handler\SamplingHandler;

class SatuanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuanbarang = SatuanBarang::latest()->get();
        return view('satuanbarang.index',compact('satuanbarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('satuanbarang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'keterangan' => 'required|string',
        ]);

         //dd($request->all()); check data

        SatuanBarang::create($request->all());

        return redirect()->route('satuanbarang.index')->with('success', 'Satuan barang berhasil ditambahkan');
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
        $satuanbarang = SatuanBarang::find($id);
        return view('satuanbarang.edit',compact('satuanbarang'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $satuanbarang = SatuanBarang:: find($id);

        $satuanbarang->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('satuanbarang.index')->with('success', 'Data satuan barang berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        try {
            SatuanBarang::destroy($id);
        } catch (\Exception $e) {
            return redirect()->route('satuanbarang.index')->with('error', 'Data satuan barang tidak bisa dihapus. Data masih digunakan di tabel lain');
        }
        return redirect()->route('satuanbarang.index')->with('success', 'Data satuan barang berhasil dihapus');
    }

}
