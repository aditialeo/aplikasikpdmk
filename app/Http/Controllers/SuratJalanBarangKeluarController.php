<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  // Pastikan ini ada di atas jika mau pakai transaction validasi logic barang tidak boleh minus
use App\Models\SuratJalanBarangKeluar;
use App\Models\BarangKeluar;
use App\Models\Barang;
use App\Models\Merk;

class SuratJalanBarangKeluarController extends Controller
{
    /**
     * Menampilkan semua surat jalan
     */
    public function index()
    {
        // ✅ UPDATED: Eager load barangKeluar untuk multi item
        $suratJalans = SuratJalanBarangKeluar::all();

        //dd($suratJalans);

        return view('suratjalan.index', compact('suratJalans'));
    }

    /**
     * Menampilkan form input surat jalan
     */
    public function create()
    {
        $barangs = Barang::all(); // atau apapun relasi yang kamu butuh
        $mereks = Merk::all(); // opsional, sesuai kebutuhanmu

        // Generate nomor surat jalan otomatis
        $count = SuratJalanBarangKeluar::whereYear('created_at', now()->year)->count() + 1;
        $nomorSurat = 'SJ/' . now()->year . '/' . str_pad($count, 4, '0', STR_PAD_LEFT);

        return view('suratjalan.create', compact('barangs', 'mereks', 'nomorSurat'));
    }


    /**
     * Store a newly created resource in storage. logic validasi jika ingin simapn cetak dan tampilakan data setelah di input pada view
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            // 'nomor_surat'     => 'required|unique:surat_jalan_barang_keluar,nomor_surat',
            'nama_sales'      => 'required',
            'nama_penerima'   => 'required',
            'tanggal_surat'   => 'required|date',
            'tanggal_keluar'  => 'required|date',
            'barang_id'       => 'required|array',
            'kd_barang'       => 'required|array',
            'merk_id'         => 'required|array',
            'jumlah_pesanan'  => 'required|array',
        ]);

        //  Mulai transaksi biar bisa rollback kalau gagal di tengah jalan
        //DB::beginTransaction();
        $suratJalan = SuratJalanBarangKeluar::create([
            'nomor_surat'     => $request->nomor_surat,
            'nama_sales'      => $request->nama_sales,
            'nama_penerima'   => $request->nama_penerima,
            'nama_customer'   => $request->nama_customer,
            'tanggal_surat'   => $request->tanggal_surat,
            'tanggal_keluar'  => $request->tanggal_keluar,
            'created_by'      => auth()->id(),
        ]);


        //try {
        //  Simpan data utama surat jalan
        // $suratJalan = SuratJalanBarangKeluar::create([
        //     'nomor_surat'     => $request->nomor_surat,
        //     'nama_sales'      => $request->nama_sales,
        //     'nama_penerima'   => $request->nama_penerima,
        //     'nama_customer'   => $request->nama_customer,
        //     'tanggal_surat'   => $request->tanggal_surat,
        //     'tanggal_keluar'  => $request->tanggal_keluar,
        //     'created_by'      => auth()->id(),
        // ]);



        //  Loop barang
        foreach ($request->barang_id as $index => $barangId) {
            $barang = Barang::find($barangId);

            //  Validasi: Apakah stok mencukupi?
            if (!$barang || $barang->stok < $request->jumlah_pesanan[$index]) {
                // Batalkan transaksi dan kembalikan pesan error
                DB::rollBack();
                return back()->with('error', 'Stok barang "' . ($barang->nm_barang ?? 'Unknown') . '" tidak mencukupi.');
            }

            //  Simpan ke barang keluar
            BarangKeluar::create([
                'surat_jalan_id' => $suratJalan->id,
                'barang_id'      => $barangId,
                'kd_barang'      => $request->kd_barang[$index],
                'merk_id'        => $request->merk_id[$index],
                'nama_customer'   => $request->nama_customer,
                'jumlah_keluar'  => $request->jumlah_pesanan[$index],
                'tanggal_keluar' => $request->tanggal_keluar,
            ]);

            // Kurangi stok
            $barang->stok -= $request->jumlah_pesanan[$index];
            $barang->save();
        }

        //  Commit transaksi
        //DB::commit();

        return redirect()->route('surat-jalan.index')->with('success', 'Surat jalan berhasil disimpan.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $suratJalan = SuratJalanBarangKeluar::with('barangKeluars.barang', 'barangKeluars.merk')->findOrFail($id);
        return view('suratjalan.show', compact('suratJalan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suratJalan = SuratJalanBarangKeluar::with('barang')->find($id);
        $barangs = Barang::all();
        $merks = Merk::all();
        return view('suratjalan.edit', compact('suratJalan', 'barangs', 'merks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'nomor_surat'     => 'required|unique:surat_jalan_barang_keluar,nomor_surat',
            'nama_sales'      => 'required',
            'nama_penerima'   => 'required',
            'tanggal_surat'   => 'required|date',
            'tanggal_keluar'  => 'required|date',
            'barang_id'       => 'required|array',
            'kd_barang'       => 'required|array',
            'merk_id'         => 'required|array',
            'jumlah_pesanan'  => 'required|array',
        ]);

        //  Mulai transaksi biar bisa rollback kalau gagal di tengah jalan
        //DB::beginTransaction();
        $suratJalan = SuratJalanBarangKeluar::updateOrCreate(
            ['nomor_surat'     => $request->nomor_surat,],
            [
                'nama_sales'      => $request->nama_sales,
                'nama_penerima'   => $request->nama_penerima,
                'nama_customer'   => $request->nama_customer,
                'tanggal_surat'   => $request->tanggal_surat,
                'tanggal_keluar'  => $request->tanggal_keluar,
                'created_by'      => auth()->id(),
            ]
        );

        foreach ($request->barang_id as $index => $barangId) {
            $barang = Barang::find($barangId);

            //  Validasi: Apakah stok mencukupi?
            if (!$barang || $barang->stok < $request->jumlah_pesanan[$index]) {
                // Batalkan transaksi dan kembalikan pesan error
                DB::rollBack();
                return back()->with('error', 'Stok barang "' . ($barang->nm_barang ?? 'Unknown') . '" tidak mencukupi.');
            }

            //  Simpan ke barang keluar
            BarangKeluar::updateOrCreate([
                'surat_jalan_id' => $suratJalan->id,
                'kd_barang'      => $request->kd_barang[$index],
            ], [
                'merk_id'        => $request->merk_id[$index],
                'jumlah_keluar'  => $request->jumlah_pesanan[$index],
                'nama_customer'   => $request->nama_customer,
                'tanggal_keluar' => $request->tanggal_keluar,
            ]);

            // Kurangi stok
            $barang->stok -= $request->jumlah_pesanan[$index];
            $barang->save();
        }

        return redirect()->route('surat-jalan.index')->with('success', 'Surat jalan berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Hapus data surat jalan
            $suratJalan = SuratJalanBarangKeluar::findOrFail($id);

            // hapus juga barang keluar terkait, relasi sudah diatur
            $suratJalan->barangKeluars()->delete();

            $suratJalan->delete();

            return redirect()->route('surat-jalan.index')->with('success', 'Surat jalan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('surat-jalan.index')->with('error', 'Gagal menghapus surat jalan: ' . $e->getMessage());
        }
    }

    public function cetak($id)
    {
        $suratJalan = SuratJalanBarangKeluar::with('barangKeluars.barang', 'barangKeluars.merk')->findOrFail($id);

        // Untuk testing awal, bisa return view biasa dulu
        return view('suratjalan.cetak', compact('suratJalan'));

        // Atau nanti kalau sudah jadi PDF pakai:
        // $pdf = PDF::loadView('suratjalan.cetak', compact('suratJalan'));
        // return $pdf->stream('surat-jalan.pdf');
    }
}
