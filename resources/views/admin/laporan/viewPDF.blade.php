<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            margin: 0 auto;
            padding: 20px;
        }
        h1, h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Laporan Pemesanan</h1>
        <h3>Tahun: {{ $year }}, Bulan: {{ $month }}</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Nota</th>
                    <th>Nama Pelanggan</th>
                    <th>Jenis Cetakan</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Selesai</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesananDetails as $index => $pemesanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pemesanan->no_nota }}</td>
                        <td>{{ $pemesanan->nama_pelanggan }}</td>
                        <td>{{ $pemesanan->jenis_cetakan }}</td>
                        <td>{{ $pemesanan->tanggal_pesanan }}</td>
                        <td>{{ $pemesanan->tanggal_selesai }}</td>
                        <td>{{ $pemesanan->total_harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
