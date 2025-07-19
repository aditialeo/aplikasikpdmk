@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Input Satuan Barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- Tombol kembali ke halaman satuan barang --}}
                    <a name="" id="" class="btn btn-secondary float-right text-xs" href="{{ route('satuanbarang.index') }}"
                        role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('satuanbarang.store') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="">Nama Satuan</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="" aria-describedby="satuan_barangHelpId" placeholder="nama">
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
