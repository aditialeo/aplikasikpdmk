@extends('adminlte::page')

@section('title', 'Tambah Surat Jalan Barang Keluar')

@section('content_header')
    <h1>Tambah Surat Jalan Barang Keluar</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('surat-jalan.store') }}" method="POST">
                @csrf

                {{-- Info Surat --}}
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" name="nomor_surat" class="form-control" value="{{ $nomorSurat }}" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Sales</label>
                    <input type="text" class="form-control" name="nama_sales" required>
                </div>

                <div class="form-group">
                    <label>Nama Penerima</label>
                    <input type="text" class="form-control" name="nama_penerima" required>
                </div>

                <div class="form-group">
                    <label>Nama Customer</label>
                    <input type="text" class="form-control" name="nama_customer" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="date" class="form-control" name="tanggal_surat" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Keluar</label>
                    <input type="date" class="form-control" name="tanggal_keluar" required>
                </div>

                <hr>

                {{-- Barang Dinamis --}}
                <h5>Detail Barang</h5>
                <div id="barang-container">
                    <div class="barang-item row">
                        <div class="col-md-3">
                            <label>Nama Barang</label>
                            <select name="barang_id[]" class="form-control barang-select" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}" data-kode="{{ $barang->kd_barang }}">
                                        {{ $barang->nm_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Kode Barang</label>
                            <input type="text" name="kd_barang[]" class="form-control kode-barang" readonly>
                        </div>
                        <div class="col-md-3">
                            <label>Nama Merek</label>
                            <select name="merk_id[]" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($mereks as $merk)
                                    <option value="{{ $merk->id }}">{{ $merk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah_pesanan[]" class="form-control" required min="1">
                        </div>
                        <div class="col-md-2">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-danger btn-block remove-barang">Hapus</button>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-barang" class="btn btn-info mt-2">+ Tambah Barang</button>

                <hr>
                <button type="submit" class="btn btn-primary">Simpan Surat Jalan</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        // Tambah baris barang
        document.getElementById('add-barang').addEventListener('click', function() {
            const container = document.getElementById('barang-container');
            const firstItem = container.querySelector('.barang-item');
            const newItem = firstItem.cloneNode(true);

            // Reset value
            newItem.querySelectorAll('input, select').forEach(el => {
                el.value = '';
            });

            container.appendChild(newItem);
        });

        // Hapus baris barang
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-barang')) {
                const items = document.querySelectorAll('.barang-item');
                if (items.length > 1) {
                    e.target.closest('.barang-item').remove();
                } else {
                    alert('Minimal satu barang harus diinput.');
                }
            }
        });

        // Auto-fill kode barang
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('barang-select')) {
                const kodeInput = e.target.closest('.barang-item').querySelector('.kode-barang');
                const selected = e.target.options[e.target.selectedIndex];
                const kode = selected.getAttribute('data-kode');
                kodeInput.value = kode;
            }
        });
    </script>
@stop
