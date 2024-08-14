@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Ubah Barang Keluar</h1>
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
                    <form id="barangForm" action="{{ route('barangkeluar.update',$data->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="kd_barang">Kode Barang</label>
                            <select class="form-control select2" name="kd_barang" id="kd_barang">
                                @foreach ($barangs as $barang)
                                    <option @if($barang->kd_barang == $data->kd_barang) selected @endif  value="{{ $barang->kd_barang }}" data-stok="{{ $barang->stok }}">
                                        {{ $barang->kd_barang }} - {{$barang->nm_barang}} (stok:{{$barang->stok}})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="suplair_id">Suplair</label>
                            <select class="form-control select2" name="suplair_id" id="suplair_id">
                                @foreach ($suplairs as $suplair)
                                    <option value="{{ $suplair->id }}" @if($suplair->id == $data->suplair_id) selected @endif>{{ $suplair->nama_suplair }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="merk_id">Merk</label>
                            <select class="form-control select2" name="merk_id" id="merk_id">
                                @foreach ($merks as $merk)
                                    <option value="{{ $merk->id }}" @if($merk->id == $data->merk_id) selected @endif>{{ $merk->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_keluar">Tanggal Keluar</label>
                            <input type="date" name="tanggal_keluar"
                                class="form-control @error('tanggal_keluar') is-invalid @enderror" id="tanggal_keluar" value="{{ $data->tanggal_keluar }}"
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
                                class="form-control @error('jumlah_keluar') is-invalid @enderror" id="jumlah_keluar" value="{{ $data->jumlah_keluar }}"
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
