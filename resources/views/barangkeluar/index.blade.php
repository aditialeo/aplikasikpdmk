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
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <a name="" id="" class="btn btn-primary text-xs float-right"
                        href="{{ route('barangkeluar.create') }}" role="button"><i class="fa fa-plus-circle"
                            aria-hidden="true"></i> Tambah Barang Keluar</a>

                    {{-- ✅ Tombol Cetak Surat Jalan (digabung) --}}
                    <a href="{{ route('surat-jalan.create') }}" class="btn btn-success text-xs float-right">
                        <i class="fa fa-file-signature"></i> Input Surat Jalan
                    </a>

                </div>
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Nama Customer </th>
                                <th>Nama Merk</th>
                                <th>Jumlah Keluar</th>
                                <th>Tanggal Keluar</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangkeluar as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->barang->nm_barang }}</td>
                                    <td>{{ $data->kd_barang }}</td>
                                    <td>{{ $data->nama_customer }}</td> {{-- ✅ Perbaikan di sini --}}
                                    <td>{{ $data->merk->nama }}</td>
                                    <td>{{ $data->jumlah_keluar }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal_keluar)->isoformat('dddd, D MMMM YYYY') }}
                                    </td>
                                    <td>
                                        @can('update-barangkeluar')
                                            <a href="{{ route('barangkeluar.edit', $data->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                        @endcan

                                        @can('delete-barangkeluar')
                                            <form action="{{ route('barangkeluar.destroy', $data->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apa Kamu yakin ingin hapus data ini?')">Delete</button>
                                            </form>
                                        @endcan


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
