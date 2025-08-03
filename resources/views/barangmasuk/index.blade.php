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
                    <a href="{{ route('barangmasuk.create') }}" class="btn btn-primary float-right text-xs">
                        <i class="fa fa-plus-circle"></i> Tambah Barang Masuk
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable w-100">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nomor Surat Jalan</th>
                                    <th>Nama Kapal</th>
                                    <th>Nomor Kontainer</th>
                                    <th>Tanggal Keberangkatan</th>
                                    <th>Nama Penerima</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Supplair</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Nama Merk</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Input Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangmasuk as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nomor_surat_jalan }}</td>
                                        <td>{{ $data->nama_kapal }}</td>
                                        <td>{{ $data->nomor_container }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->tanggal_keberangkatan)->format('Y-m-d') }}
                                        </td>
                                        <td>{{ $data->nama_penerima_barangmasuk }}</td>
                                        <td>{{ $data->barang->nm_barang }}</td>
                                        <td>{{ $data->kd_barang }}</td>
                                        <td>{{ optional($data->suplair)->nama_suplair ?? 'Tidak ada supplair' }}</td>
                                        <td>{{ $data->jumlah_masuk }}</td>
                                        <td>{{ $data->merk->nama }}</td>
                                        <td>
                                            {{ $data->tanggal_masuk ? \Carbon\Carbon::parse($data->tanggal_masuk)->isoFormat('dddd, D MMMM YYYY') : '-' }}
                                        </td>
                                        <td>{{ optional($data->user)->name ?? 'Tidak diketahui' }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                @can('update-barangmasuk')
                                                    <a href="{{ route('barangmasuk.edit', $data->id) }}"
                                                        class="btn btn-primary btn-sm mr-1">
                                                        Edit
                                                    </a>
                                                @endcan

                                                @can('delete-barangmasuk')
                                                    <form action="{{ route('barangmasuk.destroy', $data->id) }}" method="POST"
                                                        onsubmit="return confirm('Anda yakin ingin menghapus item ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> {{-- /.table-responsive --}}
                </div> {{-- /.card-body --}}
            </div> {{-- /.card --}}
        </div>
    </div>
@stop

{{-- Aktifkan plugin DataTables --}}
@section('plugins.Datatables', true)

@section('js')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                responsive: true,
                autoWidth: false,
                scrollX: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json" // Jika ingin Bahasa Indonesia
                }
            });
        });
    </script>
@stop
