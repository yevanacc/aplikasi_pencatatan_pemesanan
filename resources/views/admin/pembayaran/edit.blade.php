@extends('layout.masterAdmin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7 mx-auto">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h1>Edit Pembayaran</h1>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body" style="display: flex; flex-direction: column;">
                                <div class="mb-1">
                                    <label for="no_nota" class="form-label">No Nota</label>
                                    <input type="text" id="noNota"
                                        class="form-control @error('no_nota') is-invalid @enderror" name="no_nota"
                                        value="{{ $pembayaran->no_nota }}" required readonly>
                                    @error('no_nota')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="kode_pembayaran" class="form-label">No Pembayaran</label>
                                    <input type="text" id="kodePembayaran"
                                        class="form-control @error('kode_pembayaran') is-invalid @enderror"
                                        name="kode_pembayaran" value="{{ $pembayaran->kode_pembayaran }}" required readonly>
                                    @error('kode_pembayaran')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                {{-- <div class="mb-1">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" name="nama_pelanggan"
                                        value="{{ $pembayaran->nama_pelanggan }}" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat"
                                        value="{{ $pembayaran->alamat }}" required readonly>
                                </div> --}}

                                <div class="mb-1">
                                    <label for="tanggal_pesanan" class="form-label">Tanggal Pesanan</label>
                                    <input type="date" class="form-control" name="tanggal_pesanan"
                                        value="{{ $pembayaran->tanggal_pesanan }}" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="tanggal_selesai"
                                        value="{{ $pembayaran->tanggal_selesai }}" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                                    <input type="date" class="form-control" name="tanggal_bayar"
                                        value="{{ $pembayaran->tanggal_bayar }}" required>
                                </div>

                                {{-- <div class="mb-1">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" class="form-control" name="total_harga"
                                        value="{{ $pembayaran->total_harga }}" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="uang_muka" class="form-label">Uang Muka</label>
                                    <input type="number" class="form-control" name="uang_muka"
                                        value="{{ $pembayaran->uang_muka }}" required readonly>
                                </div> --}}

                                <div class="mb-1">
                                    <label for="sisa_pembayaran" class="form-label">Sisa Pembayaran</label>
                                    <input type="number" class="form-control" name="sisa_pembayaran"
                                        value="{{ $pembayaran->sisa_pembayaran }}" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                                    <input type="number" class="form-control" name="jumlah_pembayaran"
                                        value="{{ $pembayaran->jumlah_pembayaran }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                                    <select name="status_pembayaran" class="form-control" required>
                                        <option value="Belum Lunas"
                                            {{ $pembayaran->status_pembayaran == 'Belum Lunas' ? 'selected' : '' }}>Belum
                                            Lunas</option>
                                        <option value="Lunas"
                                            {{ $pembayaran->status_pembayaran == 'Lunas' ? 'selected' : '' }}>Lunas
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success btn-primary shadow-sm bg-green mb-2">Update
                                    Pembayaran</button>
                                <a href="{{ route('pembayaran.index') }}"
                                    class="btn btn-auto btn-primary shadow-sm">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        generateKodePembayaran();
        setTodayAsMinDate();
    });

    function generateKodePembayaran() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();

        var paymentCounter = parseInt(localStorage.getItem('paymentCounter'), 10);
        var kodePembayaran = 'PB' + yyyy + mm + dd + '-' + paymentCounter.toString().padStart(3, '0');
        document.getElementById('kodePembayaran').value = kodePembayaran;

        localStorage.setItem('paymentCounter', (paymentCounter + 1).toString());
    }

    function setTodayAsMinDate() {
        var today = new Date();
        var yyyy = today.getFullYear();
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var dd = String(today.getDate()).padStart(2, '0');

        var todayString = yyyy + '-' + mm + '-' + dd;
        var tanggalBayar = document.getElementById('tanggalBayar');
        tanggalBayar.setAttribute('min', todayString);
    }
</script>
