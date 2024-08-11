@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Input Barang </h1>
@endsection

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
                                id="kd_barang" aria-describedby="kodebarangHelpId" placeholder="Masukan Kode Barang">
                            {{-- Helper Text --}}
                            <small id="kodebarangHelpId" class="form-text text-muted"><em>Kode Barang Berupa Angka tidak boleh simbol atau huruf</em></small>
                            @error('kd_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" name="nm_barang" class="form-control @error('nm_barang') is-invalid @enderror" name="nm_barang" id=""
                                aria-describedby="nmbarangHelpId" placeholder="Nama Barang">
                                @error('nm_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                       <div class="form-group">
                         <label for="">Satuan Barang</label>
                         <select class="form-control select2" name="satuan_barang_id" id="">
                           @foreach ($satuanBarangs as $satuanBarang)
                                <option value="{{$satuanBarang->id}}">{{$satuanBarang->nama}}</option>
                           @endforeach
                         </select>
                       </div>

                        <div class="form-group">
                          <label for="">Jenis Barang</label>
                          <select class="form-control select2" name="jenis_barang_id" id="">
                            @foreach ($jenisBarangs as $jenisBarang)
                                <option value="{{$jenisBarang->id}}">{{$jenisBarang->nama}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok"
                                aria-describedby="stokHelpId" placeholder="stok">
                                @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label for="">Merk</label>
                          <select class="form-control select2" name="merk_id" id="">
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
@endsection
@section('plugins.select2', true)
@section('js')
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.9/dist/jquery.inputmask.min.js"></script>
<script>
    $(document).ready(function(){
        $('#stok,#kd_barang').inputmask('numeric', {
            rightAlign: false,
            allowMinus: false,
            allowPlus: false,
            digits: 0
        });
        $('.select2').select2();
    });
</script>
@stop
