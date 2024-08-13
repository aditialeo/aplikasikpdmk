{{-- kenapa dia extends bukan link --}}
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
                    {{-- Session pesan success --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <a name="" id="" class="btn btn-primary float-right text-xs" href="{{route('barangmasuk.create')}}"
                    role="button"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Barang Masuk</a>
                </div>
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Supplair</th>
                                <th>Jumlah Masuk</th>
                                <th>Nama Merk</th>
                                <th>#</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangmasuk as $data)
                            <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->barang->nm_barang}}</td>
                                    <td>{{$data->kd_barang}}</td>
                                    <td>{{$data->suplair->nama_suplair}}</td>
                                    <td>{{$data->jumlah_masuk}}</td>
                                    <td>{{$data->merk->nama}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a name="" id="" class="btn btn-primary text-xs" href="{{route('barangmasuk.edit',$data->id)}}" role="button">Edit</a>
                                        <form action="{{route('barangmasuk.destroy',$data->id)}}" method="post" onsubmit="return confirm('Anda yakin ingin menghapus item ini ?');">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger text-xs">Hapus</button>
                                        </form>
                                    </div>
                                    </div>
                                </td>
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
