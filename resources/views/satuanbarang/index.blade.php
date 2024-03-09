@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Data Satuan Barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a name="" id="" class="btn btn-primary float-right" href="{{route('satuanbarang.create')}}"
                    role="button"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data Satuan</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ID</th>
                                <th>Nama Satuan Barang</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($satuanbarang as $data )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->id}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->keterangan}}</td>
                                <td>
                                    <a name="" id="" class="btn btn-primary" href="{{route('satuanbarang.edit',$data->id)}}" role="button">Edit</a>
                                    <form action="{{route('satuanbarang.destroy',$data->id)}}" method="post">
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
