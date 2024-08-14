<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TitipBarang;
use Illuminate\Http\Request;

class TitipBarangController extends Controller
{
    public function index()
    {
        $titipBarang = TitipBarang::all();
        return view('titip-barang.index',compact('titipBarang'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('titip-barang.create',compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah_barang' => 'required|integer|min:1|max:' . Barang::find($request->barang_id)->stok,
            'nama_pemilik' => 'required|string|max:255',
            'alamat_pemilik' => 'required|string|max:255',
            'no_hp_pemilik' => 'required|string|max:15',
            'tanggal_titip' => 'required|date',
            'tanggal_ambil' => 'nullable|date|after_or_equal:tanggal_titip',
            'status' => 'required|string|in:Dititipkan,Diambil',
            'batas_waktu_titip' => 'nullable|date|after_or_equal:tanggal_titip',
        ]);

        TitipBarang::create($request->all());
        return redirect()->route('titip-barang.index')->with('success','Data berhasil ditambahkan');
    }

    public function edit(TitipBarang $titipBarang)
    {
        $barang = Barang::all();
        return view('titip-barang.edit',compact('titipBarang','barang'));
    }

    public function update(Request $request, TitipBarang $titipBarang)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah_barang' => 'required|integer|min:1|max:' . Barang::find($request->barang_id)->stok,
            'nama_pemilik' => 'required|string|max:255',
            'alamat_pemilik' => 'required|string|max:255',
            'no_hp_pemilik' => 'required|string|max:15',
            'tanggal_titip' => 'required|date',
            'tanggal_ambil' => 'nullable|date|after_or_equal:tanggal_titip',
            'status' => 'required|string|in:Dititipkan,Diambil',
            'batas_waktu_titip' => 'nullable|date|after or equal:tanggal_titip',
        ]);

        $titipBarang->update($request->all());
        return redirect()->route('titip-barang.index')->with('success','Data berhasil diubah');
    }

    public function destroy(TitipBarang $titipBarang)
    {
        $titipBarang->delete();
        return redirect()->route('titip-barang.index')->with('success','Data berhasil dihapus');
    }
}
