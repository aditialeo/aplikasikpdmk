@extends('adminlte::page')
@section('title', 'Aplikasi Inventory')
@section('content_header')
    <h1 class="m-0 text-dark">Tambahkan Data Titip Barang</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a name="" id="" class="btn btn-secondary float-right text-xs" href="{{ route('titip-barang.index') }}"
                    role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('titip-barang.store') }}" method="POST" id="titipBarangForm">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="barang_id">Barang</label>
                        <select class="form-control select2" id="barang_id" name="barang_id">
                            @foreach($barang as $data)
                                <option value="{{$data->id}}" data-stok="{{$data->stok}}">({{$data->kd_barang}}) wire:{{$data->nm_barang}} - Stok:{{$data->stok}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah Barang</label>
                        <input type="number" name="jumlah_barang" class="form-control @error('jumlah_barang') is-invalid @enderror" id="jumlah_barang" aria-describedby="jumlah_barangHelpId" placeholder="Jumlah Barang">
                        @error('jumlah_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_pemilik">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" id="nama_pemilik" aria-describedby="nama_pemilikHelpId" placeholder="Nama Pemilik">
                        @error('nama_pemilik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_pemilik">Alamat Pemilik</label>
                        <input type="text" name="alamat_pemilik" class="form-control @error('alamat_pemilik') is-invalid @enderror" id="alamat_pemilik" aria-describedby="alamat_pemilikHelpId" placeholder="Alamat Pemilik">
                        @error('alamat_pemilik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp_pemilik">No Hp Pemilik</label>
                        <input type="text" name="no_hp_pemilik" class="form-control @error('no_hp_pemilik') is-invalid @enderror" id="no_hp_pemilik" aria-describedby="no_hp_pemilikHelpId" placeholder="No Hp Pemilik">
                        @error('no_hp_pemilik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_titip">Tanggal Titip</label>
                        <input type="date" name="tanggal_titip" class="form-control @error('tanggal_titip') is-invalid @enderror" id="tanggal_titip" aria-describedby="tanggal_titipHelpId" placeholder="Tanggal Titip">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ambil">Tanggal Ambil</label>
                        <input type="date" name="tanggal_ambil" class="form-control @error('tanggal_ambil') is-invalid @enderror" id="tanggal_ambil" aria-describedby="tanggal_ambilHelpId" placeholder="Tanggal Ambil">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Dititipkan">Dititipkan</option>
                            <option value="Diambil">Diambil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="batas_waktu_titip">Batas Waktu Titip</label>
                        <input type="date" name="batas_waktu_titip" class="form-control @error('batas_waktu_titip') is-invalid @enderror" id="batas_waktu_titip"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('plugins.Select2', true)
@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('#titipBarangForm').on('submit', function(e) {
                var selectedBarang = $('#barang_id').find(':selected');
                var stok = selectedBarang.data('stok');
                var jumlahBarang = $('#jumlah_barang').val();

                if (parseInt(jumlahBarang) > parseInt(stok)) {
                    e.preventDefault();
                    alert('Jumlah barang tidak boleh lebih dari stok barang.');
                }
            });
        });
    </script>
@stop
