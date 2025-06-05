@extends('layout.masterAdmin')
@section('content')
    <div class="container">
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <div class="card shadow m-4">
            <div class="card-header py-3">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-0">
                    <a href="{{ route('pembayaran.create') }}" class="btn btn-auto btn-primary shadow-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-square"></i>
                        </span>
                        <span class="text">Tambah Pembayaran</span>
                    </a>
                </div>
            </div>

            <div class="card-body py-3">
                <h1>Data Pembayaran</h1>
                <div class="d-sm-flex align-items-center justify-content-between mb-0">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No Nota</th>
                                    <th scope="col">Kode Pembayaran</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Tanggal Pesanan</th>
                                    <th scope="col">Tanggal Selesai</th>
                                    <th scope="col">Tanggal Bayar</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Uang Muka</th>
                                    <th scope="col">Sisa Bayar</th>
                                    <th scope="col">Jumlah Pembayaran</th>
                                    <th scope="col">Status Pembayaran</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pembayarans as $index => $pembayaran)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pembayaran->no_nota }}</td>
                                        <td>{{ $pembayaran->kode_pembayaran }}</td>
                                        <td>{{ $pembayaran->nama_pelanggan }}</td>
                                        <td>{{ $pembayaran->alamat }}</td>
                                        <td>{{ $pembayaran->tanggal_pesanan }}</td>
                                        <td>{{ $pembayaran->tanggal_selesai }}</td>
                                        <td>{{ $pembayaran->tanggal_bayar }}</td>
                                        <td>{{ number_format($pembayaran->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ number_format($pembayaran->uang_muka, 0, ',', '.') }}</td>
                                        <td>{{ number_format($pembayaran->sisa_pembayaran, 0, ',', '.') }}</td>
                                        <td>{{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}</td>
                                        <td>{{ $pembayaran->status_pembayaran }}</td>
                                        <td>
                                            <a href="{{ route('pembayaran.edit', $pembayaran->id) }}"
                                                class="btn btn-primary mb-2">Edit</a>
                                            <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="14" class="text-center">Data Pembayaran belum Tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //message with toastr
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
