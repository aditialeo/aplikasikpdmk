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
                    {{-- Session pesan sukses --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{-- Tombol tambah barang masuk --}}
                    <a class="btn btn-primary float-right text-xs" href="{{ route('barangmasuk.create') }}" role="button">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Barang Masuk
                    </a>
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
                                <th>Input Oleh</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangmasuk as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->barang->nm_barang }}</td>
                                    <td>{{ $data->kd_barang }}</td>
                                    <td>{{ optional($data->suplair)->nama_suplair ?? 'Tidak ada supplair' }}</td>
                                    <td>{{ $data->jumlah_masuk }}</td>
                                    <td>{{ $data->merk->nama }}</td>
                                    <td>{{ optional($data->user)->name ?? 'Tidak diketahui' }}</td>

                                    <td>
                                        <div class="d-flex gap-1">
                                            {{-- Tombol Edit --}}
                                            @can('update-barangmasuk')
                                                <a class="btn btn-primary text-xs mr-1"
                                                    href="{{ route('barangmasuk.edit', $data->id) }}" role="button">Edit</a>
                                            @endcan

                                            {{-- Tombol Hapus --}}
                                            @can('delete-barangmasuk')
                                                <form action="{{ route('barangmasuk.destroy', $data->id) }}" method="post"
                                                    onsubmit="return confirm('Anda yakin ingin menghapus item ini ?');">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger text-xs">Hapus</button>
                                                </form>
                                            @endcan
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

{{-- Aktifkan plugin DataTables --}}
@section('plugins.Datatables', true)

@section('js')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@stop
