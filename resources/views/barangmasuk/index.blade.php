@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Data Barang Masuk</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a name="" id="" class="btn btn-primary float-right" href="{{route('barangmasuk.create')}}"
                    role="button"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Barang Masuk</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Supplair Id</th>
                                <th>Jumlah Masuk</th>
                                <th>Nama Merk</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangmasuk as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->id}}</td>
                                <td>{{$data->nm_barang}}</td>
                                <td>{{$data->kd_barang}}</td>
                                <td>{{$data->nama_suplair}}</td>
                                <td>{{$data->jumlah_masuk}}</td>
                                <td>{{$data->merk->nama}}</td>
                            </tr>
                            <a name="" id="" class="btn btn-primary" href="{{route('barangmasuk.edit',$data->id)}}" role="button">Edit</a>
                                    <form action="{{route('barangmasuk.destroy',$data->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
