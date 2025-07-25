@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Input Barang Masuk</h1>
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
                    <form action="{{ route('barangmasuk.store') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="">Barang</label>
                            <select class="form-control select2" name="kd_barang" id="kd_barang">
                                <option> Pilih Barang</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->kd_barang }}">({{ $barang->kd_barang }})
                                        {{ $barang->nm_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Suplair</label>
                            <select class="form-control select2" name="suplair_id" id="">
                                @foreach ($suplairs as $suplair)
                                    <option value="{{ $suplair->id }}">{{ $suplair->nama_suplair }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="">Jumlah Masuk</label>
                            <input type="text" name="jumlah_masuk"
                                class="form-control @error('jumlahmasuk') is-invalid @enderror" name="jumlahmasuk"
                                id="jumlah_masuk" aria-describedby="jumlahmasukHelpId" placeholder="Jumlah Masuk">
                            @error('jumlah_masuk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Merk</label>
                            <select class="form-control select2" name="merk_id" id="">
                                @foreach ($merks as $merk)
                                    <option value="{{ $merk->id }}">{{ $merk->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control"
                                value="{{ old('tanggal_masuk', isset($barangMasuk) ? $barangMasuk->tanggal_masuk : '') }}"
                                required>
                        </div>
                        <button type="button" id="add-barang" class="btn btn-info mt-2">+ Tambah Barang</button>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('plugins.Select2', true)
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.9/dist/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2()
            $('#jumlah_masuk').inputmask('numeric', {
                rightAlign: false,
                allowMinus: false,
                allowPlus: false,
                digits: 0
            });
        })
    </script>
@stop
