@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Ubah Barang Masuk</h1>
@stop

@section('content')
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
                    <form action="{{ route('barangmasuk.update',$barangmasuk->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <select class="form-control" name="nm_barang" id="">
                              @foreach ($barangs as $barang)
                                  <option value="{{$barang->nm_barang}}" @if ($barang->kd_barang == $barangmasuk->kd_barang)
                                    selected
                                  @endif>{{$barang->nm_barang}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="">Kode Barang</label>
                            <select class="form-control" name="kd_barang" id="">
                              @foreach ($barangs as $barang)
                                  <option value="{{$barang->kd_barang}}" @if ($barang->kd_barang == $barangmasuk->kd_barang)
                                    selected
                                  @endif>{{$barang->kd_barang}}</option>
                              @endforeach
                            </select>
                          </div>

                     <div class="form-group">
                          <label for="">Suplair</label>
                          <select class="form-control"  name="suplair_id" id="">
                            @foreach ($suplairs as $suplair)
                                <option value="{{$suplair->id}}" @if ($suplair->id == $barangmasuk->suplair_id)
                                    selected
                                  @endif>{{$suplair->nama_suplair}}</option>
                            @endforeach
                          </select>
                        </div>


                        <div class="form-group">
                            <label for="">Jumlah Masuk</label>
                            <input type="text" value="{{$barangmasuk->jumlah_masuk}}" name="jumlah_masuk" class="form-control @error('jumlah_masuk') is-invalid @enderror" name="jumlah_masuk" id=""
                                aria-describedby="jumlahmasukHelpId" placeholder="jumlahmasuk">
                                @error('jumlah_masuk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Merk</label>
                            <select class="form-control" name="merk_id" id="">
                              @foreach ($merks as $merk)
                                  <option value="{{$merk->id}}" @if ($merk->id == $barangmasuk->merk_id)
                                    selected
                                  @endif>{{$merk->nama}}</option>
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
