@extends('dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-7 col-lg-6 mx-auto">
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h1>Laporan Pemesanan</h1>
                    <div class="card-body py-3">
                        <div class="d-sm-flex align-items-center justify-content-between mb-0">
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-responsive" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pemesananFilterLaporan as $filter)
                                            <tr>
                                                <td>{{ $filter->year }}</td>
                                                <td>{{ $filter->month }}</td>
                                                <td>
                                                    <a href="{{ route('laporanPemilik.showPemesanan', ['year' => $filter->year, 'month' => $filter->month]) }}"
                                                        class="btn btn-sm btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h1>Laporan Pembayaran</h1>
                    <div class="card-body py-3">
                        <div class="d-sm-flex align-items-center justify-content-between mb-0">
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-responsive" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembayaranFilterLaporan as $filter)
                                            <tr>
                                                <td>{{ $filter->year }}</td>
                                                <td>{{ $filter->month }}</td>
                                                <td>
                                                    <a href="{{ route('laporanPemilik.showPembayaran', ['year' => $filter->year, 'month' => $filter->month]) }}"
                                                        class="btn btn-sm btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection