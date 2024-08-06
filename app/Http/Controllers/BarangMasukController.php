<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Merk;
use App\Models\RiwayatTransaksiBarang;
use App\Models\Suplair;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangmasuk = BarangMasuk::latest()->get();
        // $barangmasuk = BarangMasuk::orderBy('id','desc')->get();
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

    // api ambil nama barang
    public function getNamaBarang(Request $request)
    {
        $data['data'] = Barang::where('kd_barang',$request->kd_barang)->first();
        return response()->json($data);
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
       $barangMasuk = BarangMasuk::create($request->all());

        // if ($barangMasuk) {

        //     $request->request->add(['jenis'=>'barang_masuk'],);
        //     $request->request->add(['stok'=>$request->jumlah_masuk]);

        //     $riwayat_barang = RiwayatTransaksiBarang::create($request->all());
        //     // Cara Manual insert data eloquent
        //     // $riwayat_barang = RiwayatTransaksiBarang::create([
        //     //     'nama_barang' => $request->nama_barang,
        //     //     'kd_barang' => $request->kd_barang,
        //     //     'suplair_id' => $request->suplair_id,
        //     //     'jumlah_masuk' => $request->jumlah_masuk,
        //     //     'merk_id' => $request->merk_id,
        //     //     'jenis' => 'barang_masuk'
        //     // ]);

        //     $barang = Barang::where('kd_barang',
        //     $request->kd_barang)->increment('stok',$request->jumlah_masuk);
        // }
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
    public function edit(string $id)
    {
        $barangmasuk = BarangMasuk::find($id);
        $barangs = Barang::all();
        $merks = Merk::all();
        $suplairs= Suplair::all();

        return view('barangmasuk.edit',compact('barangs', 'merks','barangmasuk', 'suplairs'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'nm_barang' => 'required',
        'kd_barang' => 'required',
        'suplair_id' => 'required',
        'jumlah_masuk' => 'required',
        'merk_id' =>'required'
    ]);

    $barangmasuk = BarangMasuk::findOrFail($id);
    $barangmasuk->update([
        'nm_barang' => $request->nm_barang,
        'kd_barang' => $request->kd_barang,
        'suplair_id' => $request->suplair_id,
        'jumlah_masuk' => $request->jumlah_masuk,
        'merk_id' => $request->merk_id,
    ]);

    $riwayat = RiwayatTransaksiBarang::where('kd_barang',$barangmasuk->kd_barang)->latest()->first();

    if ($riwayat) {
        $stokSebelumnya = $riwayat->stok;
        $stokAkhir = $stokSebelumnya - $request->jumlah_masuk;

        if ($stokAkhir < 0) {
            $barang = Barang::where('kd_barang',$request->kd_barang)->increment('stok',abs($stokAkhir));
        }else if ($stokAkhir > 0){
            $barang = Barang::where('kd_barang',$request->kd_barang)->decrement('stok',abs($stokAkhir));
        }else if($stokAkhir == 0)
        {
            $stokAkhir = $request->jumlah_masuk;
        }

        $request->request->add(['jenis'=>'barang_masuk'],);
        $request->request->add(['stok'=>$request->jumlah_masuk]);
        $request->request->add(['nama_barang'=>$request->nm_barang]);

        $riwayat_barang = RiwayatTransaksiBarang::create($request->all());
    }

     return redirect()->route('barangmasuk.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        BarangMasuk::destroy($id);
        return redirect()->route('barangmasuk.index');

    }
}
