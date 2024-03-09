@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Ubah Data Supplair</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('suplair.update',$supplair->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Nama Supplair</label>
                            <input type="text" value="{{$supplair->name}}" name="nama_suplair" class="form-control @error('nama suplair') is-invalid @enderror" name="nama suplair"
                                id="" aria-describedby="helpId" placeholder="nama suplair">
                            @error('nama suplair')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input name="alamat" type="text" value="{{$supplair->alamat}}" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id=""
                                aria-describedby="alamatHelpId" placeholder="alamat">
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Kota</label>
                            <input name="kota" type="text" value="{{$supplair->kota}}" class="form-control @error('kota') is-invalid @enderror" name="kota" id=""
                                aria-describedby="kotaHelpId" placeholder="kota">
                                @error('kota')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">No Telepon</label>
                            <input name="no_telpon" type="text" value="{{$supplair->no_telpon}}" class="form-control @error('no telepon') is-invalid @enderror" name="no telepon" id=""
                                aria-describedby="noteleponHelpId" placeholder="no telepon">
                                @error('no telepon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
