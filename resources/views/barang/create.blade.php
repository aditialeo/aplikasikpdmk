@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Input Barang </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
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
                    <form action="{{ route('barang.store') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="form-group">
                            <label for="">Kode Barang</label>
                            <input type="text" name="kd_barang" class="form-control @error('kd_barang') is-invalid @enderror" name="kd_barang"
                                id="" aria-describedby="kodebarangHelpId" placeholder="kd_barang">
                            @error('kd_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" name="nm_barang" class="form-control @error('nm_barang') is-invalid @enderror" name="nm_barang" id=""
                                aria-describedby="nmbarangHelpId" placeholder="namabarang">
                                @error('nm_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                       <div class="form-group">
                         <label for="">Satuan Barang</label>
                         <select class="form-control" name="satuan_barang_id" id="">
                           @foreach ($satuanBarangs as $satuanBarang)
                                <option value="{{$satuanBarang->id}}">{{$satuanBarang->nama}}</option>
                           @endforeach
                         </select>
                       </div>

                        <div class="form-group">
                          <label for="">Jenis Barang</label>
                          <select class="form-control" name="jenis_barang_id" id="">
                            @foreach ($jenisBarangs as $jenisBarang)
                                <option value="{{$jenisBarang->id}}">{{$jenisBarang->nama}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" id=""
                                aria-describedby="stokHelpId" placeholder="stok">
                                @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label for="">Merk</label>
                          <select class="form-control" name="merk_id" id="">
                            @foreach ($merks as $merk)
                                <option value="{{$merk->id}}">{{$merk->nama}}</option>
                            @endforeach
                          </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
