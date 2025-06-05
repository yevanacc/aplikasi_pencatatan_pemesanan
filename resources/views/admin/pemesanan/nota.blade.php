<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100px;
        }

        .content {
            margin-top: 20px;
        }

        hr {
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ $logo_base64 }}" alt="Indo Media">
            <h1>Indo Media</h1>
            <h3>Ruko Cluster Balqis, Jakabaring, Jl.Tegal Binangun Nomor A2, Kota Palembang, Sumatera Selatan 30967</h3>
        </div>
        <hr>
        <div class="content">
            <p>No Nota: {{ $pemesananDetails->no_nota }}</p>
            <p>Tanggal Pesanan: {{ $pemesananDetails->tanggal_pesanan }}</p>
            <p>Tanggal Selesai: {{ $pemesananDetails->tanggal_selesai }}</p>
            <p>Nama Pelanggan: {{ $pemesananDetails->nama_pelanggan }}</p>
            <p>Jenis Bahan: {{ $pemesananDetails->jenis_cetakan }}</p>
            @if($pemesananDetails->jenis_cetakan == 'Banner')
                <p>Jumlah Banner: {{ $pemesananDetails->jumlah_banner }}</p>
            @else
                <p>Jumlah: {{ $pemesananDetails->jumlah }}</p>
            @endif
            <p>Total Harga: {{ number_format($pemesananDetails->total_harga, 0, ',', '.') }}</p>
            <p>Uang Muka: {{ number_format($pemesananDetails->uang_muka, 0, ',', '.') }}</p>
            <p>Sisa Pembayaran: {{ number_format($pemesananDetails->sisa_pembayaran, 0, ',', '.') }}</p>
        </div>
        <hr>
        <div class="footer">
            <h3>
                <center>Terima Kasih</center>
            </h3>
        </div>
    </div>
</body>

</html>
