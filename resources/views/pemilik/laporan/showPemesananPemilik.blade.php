@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 mx-auto">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h1>Detail Laporan Pemesanan</h1>
                        <h3>Tahun: {{ $year }}, Bulan: {{ $month }}</h3>
                        <a href="{{ route('laporanPemilik.generatePemesananPDF', ['year' => $year, 'month' => $month]) }}"
                            class="btn btn-sm btn-success">Download Laporan Pemesanan PDF</a>
                    </div>
                    <div class="card-body py-3">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No Nota</th>
                                        <th scope="col">Nama Pelanggan</th>
                                        <th scope="col">Jenis Cetakan</th>
                                        <th scope="col">Tanggal Pesanan</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemesananDetails as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $detail->no_nota }}</td>
                                            <td>{{ $detail->nama_pelanggan }}</td>
                                            <td>{{ $detail->jenis_cetakan }}</td> <!-- Menambahkan jenis cetakan -->
                                            <td>{{ $detail->tanggal_pesanan }}</td>
                                            <td>{{ $detail->tanggal_selesai }}</td>
                                            <td>{{ $detail->total_harga }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('laporanPemilik.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
