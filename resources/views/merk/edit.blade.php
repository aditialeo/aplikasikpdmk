@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Ubah Data Merk</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a name="" id="" class="btn btn-secondary float-right text-xs" href="{{ route('merk.index') }}"
                        role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('merk.update', $merk->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Nama Merk</label>
                            <input type="text" name="nama" value="{{$merk->nama}}" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="" aria-describedby="merkHelpId" placeholder="nama">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input name="keterangan" type="text" value="{{$merk->keterangan}}" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                id="" aria-describedby="keteranganHelpId" placeholder="keterangan">
                            @error('keterangan')
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
