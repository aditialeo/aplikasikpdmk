<?php

namespace App\Http\Controllers;

use App\Models\Suplair;
use Illuminate\Http\Request;

class SuplairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplair = Suplair::latest()->get();
        return view('supplair.index',compact('supplair'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplair.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_suplair' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'no_telpon' => 'required|string',
        ]);

        Suplair::create($request->all());

        return redirect()->route('suplair.index')->with('success', 'Suplair Berhasil Ditambahkan');
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
        $supplair = Suplair::find($id);

        return view('supplair.edit',compact('supplair'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request){

        $request->validate([
            'nama_suplair' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'no_telpon' => 'required|string',
        ]);

        $supplair = Suplair::find($id);

        $supplair->update([
            'nama_suplair' => $request->nama_suplair,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'no_telpon' => $request->no_telpon,
        ]);

        return to_route('suplair.index');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Suplair::destroy($id);

        return redirect()->route('suplair.index')->with('error', 'Suplair berhasil dihapus');
    }

}
