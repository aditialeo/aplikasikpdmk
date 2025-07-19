<?php

namespace App\Http\Controllers;

//
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// ✅ Custom internal models
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\JenisBarang;
use App\Models\Merk;
use App\Models\RiwayatTransaksiBarang;
use App\Models\SuratJalanBarangKeluar;

// ✅ Form request
use App\Http\Requests\BarangRequest;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangkeluar = BarangKeluar::all();

    // Ambil ID terakhir untuk dicetak
    $lastBarangKeluar = BarangKeluar::latest()->first();
    $idTerakhirBarangKeluar = $lastBarangKeluar ? $lastBarangKeluar->id : null;

    return view('barangkeluar.index', compact('barangkeluar', 'idTerakhirBarangKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
        // $suplairs = Suplair::all();
        $merks = Merk::all();
       return view('barangkeluar.create', compact('barangs', 'merks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        $barangKeluar = BarangKeluar::create($request->validated());

        if ($barangKeluar) {

            $request->request->add(['jenis' => 'barang_keluar'],);
            $request->request->add(['stok' => $request->jumlah_keluar]);

            // Membuat riwayat transaksi barang
        //    $riwayat_barang = RiwayatTransaksiBarang::create([
        //    'kd_barang' => $request->kd_barang,
        //     'merk_id' => $request->merk_id,
        //     'stok' => $request->jumlah_keluar,
        //     'jenis' => 'barang_keluar',
        //    ]);

            $barang = Barang::where(
                'kd_barang',
                $request->kd_barang
            )->decrement('stok', $request->jumlah_keluar);
        }

        return redirect()->route('barangkeluar.index')->with('success', 'Berhasil menambahkan barang keluar');
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
        $data = BarangKeluar::find($id);
        $barangs = Barang::all();
        // $suplairs = Suplair::all();
        $merks = Merk::all();
        return view('barangkeluar.edit', compact('data', 'barangs', 'merks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kd_barang' => 'required',
            'jumlah_keluar' => 'required',
            'tanggal_keluar' => 'required',
            'merk_id' => 'required',
            'nama_customer' => 'required|string',
        ]);

        //search barang keluar kemudian update stok barang berdasarkan stok barang keluar sebelumnya kemudian update barang keluar dengan stok baru kemudian update stok barang, stok barang keluar tidak boleh lebih besar dari stok barang
        $barangKeluar = BarangKeluar::find($id);
        $barang = Barang::where('kd_barang', $barangKeluar->kd_barang)->first();
        if ($request->jumlah_keluar > ($barang->stok + $barangKeluar->jumlah_keluar)) {
            return redirect()->route('barangkeluar.index')->with('error', 'Jumlah barang keluar tidak boleh lebih besar dari stok barang');
        } else {
            //update request jumlah_keluar
            $barang->update(['stok' => $barang->stok + $barangKeluar->jumlah_keluar]);
            $barang = Barang::where('kd_barang', $request->kd_barang)->decrement('stok', $request->jumlah_keluar);
            $barangKeluar->update($request->all());
            return redirect()->route('barangkeluar.index')->with('success', 'Berhasil mengubah barang keluar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //search barang keluar kemudian update jumlah barang baru kemudian hapus barang keluar
        $barangKeluar = BarangKeluar::find($id);
        $barang = Barang::where('kd_barang', $barangKeluar->kd_barang)->increment('stok', $barangKeluar->jumlah_keluar);
        $barangKeluar->delete();

        return redirect()->route('barangkeluar.index')->with('success', 'Berhasil menghapus barang keluar');
    }

    // Tambahan: cetak surat jalan otomatis + update stok
public function cetakSuratJalan($id)
{


    // Mulai transaksi agar rollback kalau error
    DB::beginTransaction();

    try {
        // Ambil data barang keluar dan relasinya
        $barangKeluar = BarangKeluar::with('barang', 'merk')->findOrFail($id);
        $barang = $barangKeluar->barang;

        // Cek apakah surat jalan sudah dibuat sebelumnya
        $existing = SuratJalanBarangKeluar::where('barang_keluar_id', $barangKeluar->id)->first();
        if ($existing) {
            return back()->with('error', 'Surat jalan sudah pernah dibuat untuk barang ini.');
        }

        // Cek stok tersedia
        if ($barang->stok < $barangKeluar->jumlah_keluar) {
            return back()->with('error', 'Stok barang tidak mencukupi!');
        }

        // Kurangi stok barang
        $barang->stok -= $barangKeluar->jumlah_keluar;
        $barang->save();

        // Generate nomor surat otomatis
        $count = SuratJalanBarangKeluar::whereYear('created_at', now()->year)->count() + 1;
        $nomor = 'SJ/' . now()->year . '/' . str_pad($count, 4, '0', STR_PAD_LEFT);

        // Buat surat jalan baru
        $suratJalan = SuratJalanBarangKeluar::create([
            'nomor_surat' => $nomor,
            'barang_keluar_id' => $barangKeluar->id,
            'tanggal_surat' => now(),
            'nama_penerima' => 'Default Penerima', // Nanti bisa pakai input form/modal
            'nama_sales' => 'Default Sales',
            'catatan' => '-',
            'created_by' => auth()->id(),
        ]);

        DB::commit(); // Simpan semua jika tidak ada error

        // Tampilkan surat jalan dalam bentuk view biasa dulu
        return view('barangkeluar.surat-jalan-pdf', compact('suratJalan', 'barangKeluar'));

    } catch (\Exception $e) {
        DB::rollBack(); // Batalkan semua kalau error
        return back()->with('error', 'Gagal mencetak surat jalan: ' . $e->getMessage());
    }
}

}
