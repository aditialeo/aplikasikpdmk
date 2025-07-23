<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Perintah Keluar Barang</title>
    <style>
        @page {
            margin: 20mm;
            /* Mengurangi header/footer default di beberapa browser */
            size: auto;
        }

        body {
            -webkit-print-color-adjust: exact !important;
            /* pastikan warna tetap */
            print-color-adjust: exact !important;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px 6px;
            text-align: center;
        }

        .no-border td {
            border: none;
        }

        .header-table td {
            vertical-align: top;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .keterangan {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <table class="header-table no-border">
        <tr>
            <td style="width: 100%">
                <strong>PT. DIRGANTARA MITRAKARYA</strong><br>
                Jl. Soekarno Hatta, Pekanbaru 28294, Riau - Indonesia<br>
                Telp: (62-761) 8007198 (Hunting), Fax: (62-761) 8007195
            </td>
        </tr>
    </table>

    <h3 style="text-align: center;">SURAT PERINTAH KELUAR BARANG (S.P.K.B)</h3>
    <p>No: {{ $suratJalan->nomor_surat }}</p>

    <p>HARAP DISERAHKAN KEPADA: <strong>{{ $suratJalan->nama_penerima }} (ATAU ITEM RETUR) DIKIRIM KE JAKARTA</strong>
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Banyaknya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suratJalan->barangKeluars as $index => $barangKeluar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>({{ $barangKeluar->kd_barang }}) {{ $barangKeluar->barang->nm_barang }} -
                        {{ $barangKeluar->merk->nama ?? '' }}</td>
                    <td>{{ $barangKeluar->jumlah_keluar }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="keterangan">
        <strong>Keterangan:</strong> Fuji Lama
    </div>

    <br><br>

    <table class="no-border">
        <tr>
            <td class="text-left">Yang menerima barang:</td>
            <td class="text-left">Yang menyerahkan barang:</td>
        </tr>
        <tr>
            <td style="height: 60px;">( {{ $suratJalan->nama_penerima }} )</td>
            <td>( {{ $suratJalan->nama_sales }} )</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>PERHATIAN:</strong> Barang-barang harus diperiksa pada waktu penyerahan dan tidak dapat
                dikembalikan/diklaim setelah diterima.
            </td>
        </tr>
    </table>

    <br>

    <table class="no-border">
        <tr>
            <td>Mengetahui,</td>
            <td class="text-center">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</td>
        </tr>
        <tr>
            <td style="height: 60px;">( ............................................. )</td>
            <td class="text-center">Hormat Kami,<br><br>( ............................................. )</td>
        </tr>
    </table>

</body>

<script>
    window.onload = function() {
        window.print();
        window.onafterprint = function() {
            window.location.href = "{{ url()->previous() }}";
        }
    }
</script>

</html>
