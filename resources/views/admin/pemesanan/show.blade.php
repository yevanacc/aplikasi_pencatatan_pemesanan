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
                    <a href="{{ route('pemesanan.create') }}" class="btn btn-auto  btn-primary shadow-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-square"></i>
                        </span>
                        <span class="text">Tambah Pesanan</span>
                    </a>

                </div>
            </div>

            <div class="card-body py-3">
                <h1>Data Pemesanan</h1>
                <div class="d-sm-flex align-items-center justify-content-between mb-0">

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No Nota</th>
                                    <th scope="col">Tanggal Pesanan</th>
                                    <th scope="col">Tanggal Selesai</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">Desain</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Uang Muka</th>
                                    <th scope="col">Sisa Pembayaran</th>
                                    <th scope="col">Status Pesanan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pemesanans as $index => $pemesanan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pemesanan->no_nota }}</td>
                                        <td>{{ $pemesanan->tanggal_pesanan }}</td>
                                        <td>{{ $pemesanan->tanggal_selesai }}</td>
                                        <td>{{ $pemesanan->nama_pelanggan }}</td>
                                        <td>{{ $pemesanan->alamat }}</td>
                                        <td>{{ $pemesanan->no_hp }}</td>
                                        <td>
                                            <img src="{{ url('storage/foto_pemesanan/' . $pemesanan->image) }}"
                                                alt="{{ $pemesanan->image }}" style="max-width: 100px;">
                                        </td>
                                        <td>{{ $pemesanan->jumlah }}</td>
                                        <td>{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ number_format($pemesanan->uang_muka, 0, ',', '.') }}</td>
                                        <td>{{ number_format($pemesanan->sisa_pembayaran, 0, ',', '.') }}</td>
                                        <td>{{ $pemesanan->status_pesanan }}</td>
                                        <td>
                                            <a href="{{ route('pemesanan.edit', $pemesanan->id) }}"
                                                class="btn btn-primary mb-2">Edit</a>
                                            <form action="{{ route('pemesanan.destroy', $pemesanan->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mb-2"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                            <a href="{{ route('pemesanan.downloadNota', $pemesanan->id) }}"
                                                class="btn btn-sm btn-success">Download Nota Pemesanan</a>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Pesanan Belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- {{ $anggotas->links() }} --}}
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
