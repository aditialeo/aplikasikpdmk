@extends('adminlte::page')

@section('title', 'Daftar Surat Jalan Barang Keluar')

@section('content_header')
    <h1>Daftar Surat Jalan Barang Keluar</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('surat-jalan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Surat Jalan
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Nama Sales</th>
                        <th>Nama Penerima</th>
                        <th>Tanggal Surat</th>
                        <th>Tanggal Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suratJalans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nomor_surat }}</td>
                            <td>{{ $item->nama_sales }}</td>
                            <td>{{ $item->nama_penerima }}</td>
                            <td>{{ $item->tanggal_surat }}</td>
                            <td>{{ $item->tanggal_keluar }}</td>
                            <td>
                                <a href="{{ route('surat-jalan.show', $item->id) }}" class="btn btn-sm btn-info"
                                    title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('surat-jalan.edit', $item->id) }}" class="btn btn-sm btn-warning"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('surat-jalan.destroy', $item->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <a href="{{ route('surat-jalan.cetak', $item->id) }}" class="btn btn-sm btn-secondary"
                                    title="Cetak PDF" target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data surat jalan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
