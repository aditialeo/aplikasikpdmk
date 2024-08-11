@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Data Barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a name="" id="" class="btn btn-primary float-right text-xs" href="{{ route('barang.create') }}"
                        role="button"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Barang</a>
                </div>
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan Barang </th>
                                <th>Jenis Barang </th>
                                <th>Stok</th>
                                <th>Nama Merk</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $data)
                                    <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kd_barang }}</td>
                                    <td>{{ $data->nm_barang }}</td>
                                    <td>{{ $data->satuanBarang->nama }}</td>
                                    <td>{{ $data->jenisBarang->nama }}</td>
                                    <td>{{ $data->stok }}</td>
                                    <td>{{ $data->merk->nama }}</td>

                                    <td>
                                        <div class="d-flex">
                                            <a name="" id="" class="btn btn-primary mr-2 text-xs"
                                                href="{{ route('barang.edit', $data->id) }}" role="button">Edit</a>
                                            <form action="{{ route('barang.destroy', $data->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger text-xs">Hapus</button>
                                            </form>
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
@section('plugins.Datatables', true)
@section('js')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@stop
