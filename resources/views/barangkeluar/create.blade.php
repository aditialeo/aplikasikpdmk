@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Input Barang Keluar</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-title">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form id="barangForm" action="{{ route('barangkeluar.store') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="form-group">
                            <label for="kd_barang">Kode Barang</label>
                            <select class="form-control select2" name="kd_barang" id="kd_barang">
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->kd_barang }}" data-stok="{{ $barang->stok }}">
                                        {{ $barang->kd_barang }} - {{ $barang->nm_barang }} (stok:{{ $barang->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama_customer">Nama Customer</label>
                            <input type="text" name="nama_customer"
                                class="form-control @error('nama_customer') is-invalid @enderror"
                                value="{{ old('nama_customer') }}" placeholder="Masukkan nama customer">
                            @error('nama_customer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="merk_id">Merk</label>
                            <select class="form-control select2" name="merk_id" id="merk_id">
                                @foreach ($merks as $merk)
                                    <option value="{{ $merk->id }}">{{ $merk->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_keluar">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar"
                                class="form-control @error('tanggal_keluar') is-invalid @enderror" id="tanggal_keluar"
                                aria-describedby="tanggal_keluarHelpId" placeholder="Tanggal Keluar">
                            @error('tanggal_keluar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jumlah_keluar">Jumlah Keluar</label>
                            <input type="text" name="jumlah_keluar"
                                class="form-control @error('jumlah_keluar') is-invalid @enderror" id="jumlah_keluar"
                                aria-describedby="jumlah_keluarHelpId" placeholder="Jumlah Keluar">
                            @error('jumlah_keluar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Hidden input to store the selected stok value -->
                        <input type="hidden" id="stok" name="stok">

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('plugins.select2', true)

@section('js')
    <!-- Input mask cdnjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // Input mask for jumlah_keluar
            $('#jumlah_keluar').inputmask({
                alias: 'numeric',
                groupSeparator: ',',
                autoGroup: true,
                digits: 0,
                rightAlign: false,
                allowMinus: false
            });

            // Update stok value when a new Kode Barang is selected
            $('#kd_barang').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var stok = selectedOption.data('stok');
                $('#stok').val(stok);
            });

            // Form submission validation
            $('#barangForm').on('submit', function(e) {
                var stok = parseInt($('#stok').val());
                var jumlahKeluar = parseInt($('#jumlah_keluar').inputmask('unmaskedvalue'));

                if (jumlahKeluar > stok) {
                    e.preventDefault();
                    alert('Jumlah Tidak Boleh Melebihi Stok');
                }
            });
        });
    </script>
@stop
