@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 mx-auto">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h1>Detail Laporan Pembayaran</h1>
                        <h3>Tahun: {{ $year }}, Bulan: {{ $month }}</h3>
                        <a href="{{ route('laporanPemilik.generatePembayaranPDF', ['year' => $year, 'month' => $month]) }}"
                            class="btn btn-sm btn-success">Download Laporan Pembayaran PDF</a>
                    </div>
                    <div class="card-body py-3">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No Pembayaran</th>
                                        <th scope="col">Tanggal Pembayaran</th>
                                        {{-- <th scope="col">Tanggal Selesai</th> --}}
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Jumlah Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaranDetails as $index => $pembayaran)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pembayaran->kode_pembayaran }}</td>
                                            <td>{{ $pembayaran->tanggal_bayar }}</td>
                                            {{-- <td>{{ $pembayaran->tanggal_selesai }}</td> --}}
                                            <td>{{ $pembayaran->total_harga }}</td>
                                            <td>{{ $pembayaran->jumlah_pembayaran }}</td>
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
