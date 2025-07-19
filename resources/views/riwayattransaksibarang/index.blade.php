@extends('adminlte::page')

@section('title', 'Aplikasi Inventory')

@section('content_header')
    <h1 class="m-0 text-dark">Riwayat Transaksi Barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Suplair</th>
                                <th>Merk</th>
                                <th>Jumlah</th>
                                <th>Jenis</th>
                                <th>Tanggal Transaksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayattransaksibarang as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kd_barang }}</td>
                                    <td>{{ $data->barang->nm_barang ?? '-' }}</td>
                                    <td>{{ $data->suplair->nama_suplair ?? '-' }}</td>
                                    <td>{{ $data->merk->nama ?? '-' }}</td>
                                    <td>{{ $data->stok }}</td>
                                    <td>{{ $data->jenis }}</td>
                                    <td>{{ $data->created_at->format('d M Y') }}</td>
                                    <td>
                                        <form action="{{ route('riwayattransaksibarang.destroy', $data->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Anda yakin ingin menghapus item ini ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-xs">Hapus</button>
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

@section('plugins.Datatables', true)

@section('js')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                ordering: false,
                paging: false,
                searching: true,
            });
        });
    </script>
@stop
