@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Input Barang Masuk</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('barangmasuk.store') }}" method="post">
                @csrf
                @method('post')

                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Informasi Surat Jalan --}}
                <div class="card mb-4">
                    <div class="card-header"><strong>Informasi Pengiriman</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nomor Surat Jalan</label>
                            <input type="text" name="nomor_surat_jalan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Kapal</label>
                            <input type="text" name="nama_kapal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor Container</label>
                            <input type="text" name="nomor_container" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Keberangkatan</label>
                            <input type="date" name="tanggal_keberangkatan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Penerima Barang</label>
                            <input type="text" name="nama_penerima_barangmasuk" class="form-control" required>
                        </div>
                    </div>
                </div>

                {{-- Form Dinamis Barang --}}
                <div class="card">
                    <div class="card-header"><strong>Detail Barang Masuk</strong></div>
                    <div class="card-body">
                        <table class="table" id="barang-table">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Suplair</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="barang-body">
                                <tr>
                                    <td>
                                        <select name="barang[0][kd_barang]" class="form-control select2" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($barangs as $barang)
                                                <option value="{{ $barang->kd_barang }}">{{ $barang->nm_barang }} -
                                                    {{ $barang->kd_barang }}</option>
                                            @endforeach
                                        </select>

                                    </td>
                                    <td>
                                        <select name="barang[0][merk_id]" class="form-control select2" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($merks as $merk)
                                                <option value="{{ $merk->id }}">{{ $merk->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="barang[0][suplair_id]" class="form-control select2" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($suplairs as $suplair)
                                                <option value="{{ $suplair->id }}">{{ $suplair->nama_suplair }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="barang[0][jumlah_masuk]" class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="date" name="barang[0][tanggal_masuk]" class="form-control" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" id="add-row" class="btn btn-info">+ Tambah Barang</button>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan Barang Masuk</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('plugins.Select2', true)

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.9/dist/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            let index = 1;

            $('#add-row').click(function() {
                let row = `
                    <tr>
                        <td>
                            <select name="barang[${index}][kd_barang]" class="form-control select2" required>
                                 <option value="">-- Pilih --</option>
                                  @foreach ($barangs as $barang)
                                    <option value="{{ $barang->kd_barang }}">{{ $barang->nm_barang }} - {{ $barang->kd_barang }}</option>
                                  @endforeach
                             </select>
                        </td>
                        <td>
                            <select name="barang[${index}][merk_id]" class="form-control select2" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($merks as $merk)
                                    <option value="{{ $merk->id }}">{{ $merk->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="barang[${index}][suplair_id]" class="form-control select2" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($suplairs as $suplair)
                                    <option value="{{ $suplair->id }}">{{ $suplair->nama_suplair }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="barang[${index}][jumlah_masuk]" class="form-control" required>
                        </td>
                        <td>
                            <input type="date" name="barang[${index}][tanggal_masuk]" class="form-control" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button>
                        </td>
                    </tr>`;
                $('#barang-body').append(row);
                $('.select2').select2(); // re-inisialisasi select2 setelah ditambahkan
                index++;
            });

            // tombol hapus baris
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@stop
