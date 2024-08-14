@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Data Supplair</h1>
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
                    <a name="" id="" class="btn btn-primary float-right text-xs"
                        href="{{ route('suplair.create') }}" role="button"><i class="fa fa-plus-circle"
                            aria-hidden="true"></i> Tambah Data Suplier</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ID</th>
                                <th>Nama Supplair</th>
                                <th>Alamat</th>
                                <th>kota</th>
                                <th>No Telpon</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplair as $data)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->nama_suplair }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->kota }}</td>
                                    <td>{{ $data->no_telpon }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a name="" id="" class="btn btn-primary text-xs"
                                                href="{{ route('suplair.edit', $data->id) }}" role="button">Edit</a>
                                            <form action="{{ route('suplair.destroy', $data->id) }}" method="post"
                                                onsubmit="return confirm('Hapus Data ini ?')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger text-xs">Hapus</button>
                                            </form>
                                        </div>
                                        </div>
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
@section('plugins.datatables', true)
@section('js')
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
@stop
