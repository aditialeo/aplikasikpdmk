@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Input Merk</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('merk.store') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="">Nama Merk</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="" aria-describedby="merkHelpId" placeholder="nama">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input name="keterangan" type="text"  class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
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
