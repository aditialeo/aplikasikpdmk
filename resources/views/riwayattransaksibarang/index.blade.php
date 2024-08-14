@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Riwayat Transaksi Barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Suplair</th>
                            <th>Merk</th>
                            <th>Jumlah Masuk</th>
                            <th>Jenis</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayattransaksibarang as $data)
                        <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->nama_barang}}</td>
                                <td>{{$data->kd_barang}}</td>
                                <td>{{$data->suplair->nama_suplair}}</td>
                                <td>{{$data->merk->nama}}</td>
                                <td>{{$data->stok}}</td>
                                <td>{{$data->jenis}}</td>
                                <td>{{$data->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('plugins.Datatables', true)
@section('js')
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
@stop
