@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Barang Keluar</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a name="" id="" class="btn btn-primary float-right" href="{{route('barangkeluar.create')}}"
                    role="button"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Barang Keluar</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Supplair </th>
                                <th>Nama Merk</th>
                                <th>Jumlah Keluar</th>
                                <th>Tanggal Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangkeluar as $data)
                            <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->nama_barang}}</td>
                                    <td>{{$data->kd_barang}}</td>
                                    <td>{{$data->suplair->nama_suplair}}</td>
                                    <td>{{$data->merk->nama}}</td>
                                    <td>{{$data->jumlah_keluar}}</td>
                                    <td>{{\Carbon\Carbon::parse($data->tanggal_keluar)->isoformat('dddd, D MMMM YYYY')}}</td>
                            </tr>
                            @endforeach
                        </tbody>

                       </table>
                    </div>
                </div>
            </div>
        </div>

@stop
