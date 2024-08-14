@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Buat Data Supplair</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <a name="" id="" class="btn btn-secondary float-right text-xs"
                        href="{{ route('suplair.index') }}" role="button"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('suplair.store') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="">Nama Supplair</label>
                            <input type="text" name="nama_suplair"
                                class="form-control @error('nama suplair') is-invalid @enderror" name="nama suplair"
                                id="" aria-describedby="helpId" placeholder="nama suplair">
                            @error('nama suplair')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat" id="" aria-describedby="alamatHelpId" placeholder="alamat">
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Kota</label>
                            <input name="kota" type="text" class="form-control @error('kota') is-invalid @enderror"
                                name="kota" id="" aria-describedby="kotaHelpId" placeholder="kota">
                            @error('kota')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">No Telepon</label>
                            <input name="no_telpon" type="text"
                                class="form-control @error('no telepon') is-invalid @enderror" id="telepon"
                                aria-describedby="noteleponHelpId" placeholder="no telepon">
                            @error('no telepon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary text-xs">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    //script cdnjs inputmask
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#telepon').inputmask({
                alias: 'numeric',
                groupSeparator: '',
                autoGroup: true,
                digits: 0,
                rightAlign: false,
                allowMinus: false
            });
        });
    </script>
@stop
