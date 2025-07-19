@extends('adminlte::page')

@section('title', 'Detail Surat Jalan')

@section('content_header')
    <h1>Detail Surat Jalan Barang Keluar</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <h5>Informasi Surat Jalan</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Nomor Surat</th>
                    <td>{{ $suratJalan->nomor_surat }}</td>
                </tr>
                <tr>
                    <th>Nama Sales</th>
                    <td>{{ $suratJalan->nama_sales }}</td>
                </tr>
                <tr>
                    <th>Nama Penerima</th>
                    <td>{{ $suratJalan->nama_penerima }}</td>
                </tr>
                <tr>
                    <th>Nama Customer</th>
                    <td>{{ $suratJalan->nama_customer }}</td>
                </tr>
                <tr>
                    <th>Tanggal Surat</th>
                    <td>{{ $suratJalan->tanggal_surat }}</td>
                </tr>
                <tr>
                    <th>Tanggal Keluar</th>
                    <td>{{ $suratJalan->tanggal_keluar }}</td>
                </tr>
            </table>

            <h5 class="mt-4">Detail Barang</h5>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Merk</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suratJalan->barangKeluars as $index => $barangKeluar)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barangKeluar->barang->nm_barang ?? '-' }}</td>
                            <td>{{ $barangKeluar->kd_barang }}</td>
                            <td>{{ $barangKeluar->merk->nama ?? '-' }}</td>
                            <td>{{ $barangKeluar->jumlah_keluar }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('surat-jalan.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>
    </div>

@stop
