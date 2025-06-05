<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
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

        h1,
        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Laporan Pembayaran</h1>
        <h3>Tahun: {{ $year }}, Bulan: {{ $month }}</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Total Harga</th>
                    <th>Jumlah Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaranDetails as $index => $pembayaran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pembayaran->kode_pembayaran }}</td>
                        <td>{{ $pembayaran->tanggal_bayar }}</td>
                        <td>{{ $pembayaran->total_harga }}</td>
                        <td>{{ $pembayaran->jumlah_pembayaran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
