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
        return view('barangmasuk.index', compact('barangmasuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $merks = Merk::all();
        $barangs = Barang::all();
        $suplairs = Suplair::all();
        return view('barangmasuk.create', compact('barangs', 'suplairs', 'merks'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi semua input termasuk input tambahan dan array barang
        $request->validate([
            // Field informasi tambahan (hanya 1x per transaksi)
            'nomor_surat_jalan' => 'required|string',
            'nama_kapal' => 'required|string',
            'nomor_container' => 'required|string',
            'tanggal_keberangkatan' => 'required|date',
            'nama_penerima_barangmasuk' => 'required|string',

            // Validasi isi array barang[] (setiap baris wajib isi semua)
            'barang.*.kd_barang' => 'required',               // kode barang wajib
            'barang.*.suplair_id' => 'required',              // suplair wajib
            'barang.*.jumlah_masuk' => 'required|numeric',    // jumlah masuk harus angka
            'barang.*.merk_id' => 'required',                 // merk wajib
            'barang.*.tanggal_masuk' => 'required|date',      // tanggal masuk harus format tanggal
        ]);

        // dd($request->all());

        // Loop setiap barang yang dikirim dari form
        foreach ($request->barang as $item) {

            // Simpan ke tabel barang_masuk
            BarangMasuk::create([
                'kd_barang' => $item['kd_barang'],
                'suplair_id' => $item['suplair_id'],
                'jumlah_masuk' => $item['jumlah_masuk'],
                'merk_id' => $item['merk_id'],
                'tanggal_masuk' => $item['tanggal_masuk'],

                // Salin data tambahan dari atas ke setiap baris barang_masuk
                'nomor_surat_jalan' => $request->nomor_surat_jalan,
                'nama_kapal' => $request->nama_kapal,
                'nomor_container' => $request->nomor_container,
                'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
                'nama_penerima_barangmasuk' => $request->nama_penerima_barangmasuk,

                // Ambil ID user yang login
                'user_id' => auth()->id(),
            ]);

            // Ambil data barang berdasarkan kode
            $barangModel = Barang::where('kd_barang', $item['kd_barang'])->first();

            // Simpan ke riwayat transaksi barang
            RiwayatTransaksiBarang::create([
                'kd_barang' => $item['kd_barang'],
                'nama_barang' => $barangModel->nm_barang,
                'jenis' => 'barang_masuk',
                'stok' => $item['jumlah_masuk'],
                'suplair_id' => $item['suplair_id'],
                'merk_id' => $item['merk_id'],
                'tanggal_transaksi' => now(),
            ]);
        }

        // Setelah semua selesai, redirect kembali ke halaman index
        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil ditambahkan');
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
        $suplairs = Suplair::all();

        return view('barangmasuk.edit', compact('barangs', 'merks', 'barangmasuk', 'suplairs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kd_barang' => 'required',
            'suplair_id' => 'required',
            'jumlah_masuk' => 'required',
            'merk_id' => 'required',
            'tanggal_masuk' => 'required|date',

        ]);

        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk->update([
            'nm_barang' => $request->nm_barang,
            'kd_barang' => $request->kd_barang,
            'suplair_id' => $request->suplair_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            'merk_id' => $request->merk_id,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        $riwayat = RiwayatTransaksiBarang::where('kd_barang', $barangmasuk->kd_barang)->latest()->first();

        if ($riwayat) {
            $stokSebelumnya = $riwayat->stok;
            $stokAkhir = $stokSebelumnya - $request->jumlah_masuk;

            if ($stokAkhir < 0) {
                $barang = Barang::where('kd_barang', $request->kd_barang)->increment('stok', abs($stokAkhir));
            } else if ($stokAkhir > 0) {
                $barang = Barang::where('kd_barang', $request->kd_barang)->decrement('stok', abs($stokAkhir));
            } else if ($stokAkhir == 0) {
                $stokAkhir = $request->jumlah_masuk;
            }

            $request->request->add(['jenis' => 'barang_masuk'],);
            $request->request->add(['stok' => $request->jumlah_masuk]);
            $request->request->add(['nama_barang' => $request->nm_barang]);

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
