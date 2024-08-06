<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisbarang = JenisBarang::latest()->get();
        return view('jenisbarang.index',compact('jenisbarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenisbarang.create');
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

          //dd($request->all());

        JenisBarang::create($request->all());

        return to_route('jenisbarang.index');


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
        $jenisbarang = JenisBarang::find($id);

        return view('jenisbarang.edit',compact('jenisbarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request){

        $request->validate([
            'nama' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $jenisbarang = JenisBarang::find($id);

        $jenisbarang->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        return to_route('jenisbarang.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        JenisBarang::destroy($id);

        return to_route('jenisbarang.index');
    }

}
