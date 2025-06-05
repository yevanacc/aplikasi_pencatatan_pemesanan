@extends('layout.masterAdmin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7 mx-auto">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h1>Tambah Pembayaran</h1>
                    </div>

                    <div class="card-body">
                        <form id="paymentForm" action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body" style="display: flex; flex-direction: column;">
                                <div class="mb-1">
                                    <label for="no_nota" class="form-label">No Nota</label>
                                    <input type="text" id="noNota" class="form-control @error('no_nota') is-invalid @enderror" name="no_nota" required>
                                    @error('no_nota')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="kode_pembayaran" class="form-label">No Pembayaran</label>
                                    <input type="text" id="kodePembayaran" class="form-control @error('kode_pembayaran') is-invalid @enderror" name="kode_pembayaran" required readonly>
                                    @error('kode_pembayaran')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" name="nama_pelanggan" id="namaPelanggan" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" class="form-control" name="no_hp" id="noHp" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="tanggal_pesanan" class="form-label">Tanggal Pesan</label>
                                    <input type="date" class="form-control" name="tanggal_pesanan" id="tanggal_pesanan" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="tanggal_selesai" id="tanggalSelesai" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                                    <input type="date" class="form-control" name="tanggal_bayar" id="tanggalBayar" min="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="mb-1">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="text" class="form-control" name="total_harga" id="totalHarga" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="uang_muka" class="form-label">Uang Muka</label>
                                    <input type="text" class="form-control" name="uang_muka" id="uangMuka" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="sisa_pembayaran" class="form-label">Sisa Pembayaran</label>
                                    <input type="text" class="form-control" name="sisa_pembayaran" id="sisaPembayaran" required readonly>
                                </div>

                                <div class="mb-1">
                                    <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                                    <input type="number" class="form-control" name="jumlah_pembayaran" required>
                                </div>

                                <div class="mb-3">
                                    <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                                    <select name="status_pembayaran" class="form-control" required>
                                        <option value="Belum Lunas" selected>Belum Lunas</option>
                                        <option value="Lunas">Lunas</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success btn-primary shadow-sm bg-green mb-2">Tambah Pembayaran</button>
                                <a href="{{ route('pembayaran.index') }}" class="btn btn-auto btn-primary shadow-sm">Batal</a>
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
        initializePaymentCounter();
        generateKodePembayaran();
        setTodayAsMinDate();

        document.getElementById('noNota').addEventListener('input', function() {
            fillFormBasedOnNota(this.value);
        });

        document.getElementById('paymentForm').addEventListener('submit', function() {
            // Remove thousand separators before submitting the form
            document.getElementById('totalHarga').value = removeThousandSeparators(document.getElementById('totalHarga').value);
            document.getElementById('uangMuka').value = removeThousandSeparators(document.getElementById('uangMuka').value);
            document.getElementById('sisaPembayaran').value = removeThousandSeparators(document.getElementById('sisaPembayaran').value);
        });
    });

    const pemesanans = @json($pemesanans);

    function initializePaymentCounter() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();
        var todayString = yyyy + '-' + mm + '-' + dd;

        var storedDate = localStorage.getItem('paymentDate');
        if (storedDate !== todayString) {
            localStorage.setItem('paymentDate', todayString);
            localStorage.setItem('paymentCounter', '1');
        }
    }

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

    function fillFormBasedOnNota(noNota) {
        const pesanan = pemesanans.find(p => p.no_nota === noNota);

        if (pesanan) {
            document.getElementById('namaPelanggan').value = pesanan.nama_pelanggan;
            document.getElementById('alamat').value = pesanan.alamat;
            document.getElementById('noHp').value = pesanan.no_hp;
            document.getElementById('tanggal_pesanan').value = pesanan.tanggal_pesanan;
            document.getElementById('tanggalSelesai').value = pesanan.tanggal_selesai;
            document.getElementById('totalHarga').value = formatNumber(pesanan.total_harga);
            document.getElementById('uangMuka').value = formatNumber(pesanan.uang_muka);
            document.getElementById('sisaPembayaran').value = formatNumber(pesanan.sisa_pembayaran);
        } else {
            document.getElementById('namaPelanggan').value = '';
            document.getElementById('alamat').value = '';
            document.getElementById('noHp').value = '';
            document.getElementById('tanggal_pesanan').value = '';
            document.getElementById('tanggalSelesai').value = '';
            document.getElementById('totalHarga').value = '';
            document.getElementById('uangMuka').value = '';
            document.getElementById('sisaPembayaran').value = '';
        }
    }

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function removeThousandSeparators(number) {
        return number.replace(/\./g, '');
    }
</script>
