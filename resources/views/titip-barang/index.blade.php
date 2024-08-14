{{-- kenapa dia extends bukan link --}}
@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Titip Barang</h1>
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
                    <a name="" id="" class="btn btn-primary float-right text-xs" href="{{route('titip-barang.create')}}"
                    role="button"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambahkan Data Titipan Barang</a>
                </div>
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Nama Pemilik</th>
                                <th>Alamat Pemilik</th>
                                <th>No Hp Pemilik</th>
                                <th>Tanggal Titip</th>
                                <th>Tanggal Ambil</th>
                                <th>Status</th>
                                <th>Batas Waktu Titip</th>
                                <th>#</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($titipBarang as $data)
                            <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->barang->nm_barang}}</td>
                                    <td>{{$data->barang->kd_barang}}</td>
                                    <td>{{$data->nama_pemilik}}</td>
                                    <td>{{$data->alamat_pemilik}}</td>
                                    <td>{{$data->no_hp_pemilik}}</td>
                                    <td>{{$data->tanggal_titip}}</td>
                                    <td>{{$data->tanggal_ambil}}</td>
                                    <td>{{$data->status}}</td>
                                    <td>{{$data->batas_waktu_titip}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a name="" id="" class="btn btn-primary text-xs" href="{{route('titip-barang.edit',$data->id)}}" role="button">Edit</a>
                                        <form action="{{route('titip-barang.destroy',$data->id)}}" method="post" onsubmit="return confirm('Anda yakin ingin menghapus item ini ?');">
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
