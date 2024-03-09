<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merk = Merk::latest()->get();
        return view('merk.index',compact('merk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('merk.create');
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

        Merk::create($request->all());



        return to_route('merk.index');
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
        $merk = Merk::find($id);

        return view('merk.edit',compact('merk'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request){

        $request->validate([
            'nama' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $merk = Merk::find($id);

        $merk->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        return to_route('merk.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){

        // $user = User::find($id);
        // $user->delete();

        Merk::destroy($id);

        return to_route('merk.index');
    }

}

