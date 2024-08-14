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
}
