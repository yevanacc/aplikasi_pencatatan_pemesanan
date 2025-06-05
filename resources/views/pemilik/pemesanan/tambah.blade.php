@extends('dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-8 col-lg-7 mx-auto">
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h1>Tambah Pesanan</h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body" style="display: flex; flex-direction: column;">
                            <div class="mb-1">
                                <label for="no_nota" class="form-label">No Nota</label>
                                <input type="text" id="noNota"
                                    class="form-control @error('no_nota') is-invalid @enderror" name="no_nota" required
                                    readonly>
                                @error('no_nota')
                                    <div class="text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="tanggal_pesanan" class="form-label">Tanggal Pesanan</label>
                                <input type="date" class="form-control" name="tanggal_pesanan" id="tanggalPesanan"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="mb-1">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="tanggal_selesai" id="tanggalSelesai"
                                    min="{{ date('Y-m-d') }}">
                            </div>

                            <div class="mb-1">
                                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" name="nama_pelanggan" required>
                            </div>

                            <div class="mb-1">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" required>
                            </div>

                            <div class="mb-1">
                                <label for="no_hp" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" name="no_hp" required>
                            </div>

                            <div class="mb-1">
                                <label for="image" class="form-label">Desain</label>
                                <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png,.gif"
                                    required>
                            </div>

                            <div class="mb-1">
                                <label for="nama_bahan" class="form-label">Nama Bahan</label>
                                <select name="nama_bahan[]" class="form-control nama-bahan-dropdown" required
                                    onchange="document.getElementById('totalHarga').value = ''">
                                    <option value="">Pilih Nama Bahan</option>
                                    @foreach ($bahanList as $bahan)
                                        <option value="{{ $bahan->nama_bahan }}" data-kode="{{ $bahan->kode_cetakan }}"
                                            data-nama="{{ $bahan->nama_cetakan }}"
                                            data-harga="{{ $bahan->harga_cetakan }}" data-satuan="{{ $bahan->satuan }}">
                                            {{ $bahan->nama_bahan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tabel untuk detail bahan -->
                            <table class="mt-1 mb-1" border="1" cellpadding="8" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Kode Cetakan</th>
                                        <th>Jenis Cetakan</th>
                                        <th>Harga</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="kode_cetakan[]"
                                                class="form-control kode-cetakan" readonly></td>
                                        <td><input type="text" name="jenis_cetakan[]"
                                                class="form-control jenis-cetakan" readonly></td>
                                        <td><input type="text" name="harga_cetakan[]" class="form-control harga"
                                                readonly></td>
                                        <td><input type="text" name="satuan[]" class="form-control satuan" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="mb-3 ukuran-group" style="display: none;">
                                <label for="ukuran" class="form-label">Ukuran</label>
                                <select name="ukuran[]" class="form-control ukuran-dropdown">
                                    <option value="-">-</option>
                                    <option value="Custom">Custom Ukuran</option>
                                </select>
                            </div>

                            <div class="mb-1 custom-dimension-inputs" style="display: none;">
                                <label for="panjang" class="form-label">Panjang</label>
                                <input type="number" class="form-control panjang" name="panjang[]">
                            </div>

                            <div class="mb-1 custom-dimension-inputs" style="display: none;">
                                <label for="lebar" class="form-label">Lebar</label>
                                <input type="number" class="form-control lebar" name="lebar[]">
                            </div>

                            <div class="mb-1 custom-dimension-inputs" style="display: none;">
                                <label for="jumlah_banner" class="form-label">Jumlah</label>
                                <input type="number" class="form-control jumlah_banner" name="jumlah_banner[]">
                            </div>

                            <div class="mb-1 jumlah-group">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control jumlah" name="jumlah">
                            </div>

                            <div class="mb-1">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="number" id="totalHarga" class="form-control total_harga"
                                    name="total_harga" required readonly>
                            </div>

                            <div class="mb-1 jumlah-group">
                                <label for="uang_muka" class="form-label">Uang Muka</label>
                                <input type="number" class="form-control jumlah" id="uang_muka" name="uang_muka">
                            </div>

                            <div class="mb-1 jumlah-group">
                                <label for="sisa_pembayaran" class="form-label">Sisa Pembayaran</label>
                                <input type="number" class="form-control jumlah" id="sisa_pembayaran"
                                    name="sisa_pembayaran" required readonly>
                            </div>


                            <div class="mb-3">
                                <label for="status_pesanan" class="form-label">Status Pesanan</label>
                                <select name="status_pesanan" class="form-control" required>
                                    <option value="Belum Selesai" selected>Belum Selesai</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>

                            {{-- <!-- Input untuk detail bahan -->
                            <input type="hidden" name="nama_bahan" id="namaBahan" value="">
                            <input type="hidden" name="kode_cetakan" id="kodeCetakan" value="">
                            <input type="hidden" name="jenis_cetakan" id="jenisCetakan" value="">
                            <input type="hidden" name="harga_cetakan" id="hargaCetakan" value="">
                            <input type="hidden" name="ukuran" id="ukuran" value="">
                            <input type="hidden" name="panjang" id="panjang" value="">
                            <input type="hidden" name="lebar" id="lebar" value="">
                            <input type="hidden" name="jumlah_banner" id="jumlahBanner" value=""> --}}

                            <button type="submit" class="btn btn-success btn-primary shadow-sm bg-green mb-2">Tambah
                                Pesanan</button>
                            <a href="{{ route('pemesananPemilik.index') }}"
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
    // let orderCounter = 0001;
    document.addEventListener('DOMContentLoaded', function() {
        initializeOrderCounter();
        generateNoNota();
        setTodayAsMinDate();
        // Event listener untuk dropdown nama bahan
        document.querySelector('.nama-bahan-dropdown').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var kodeCetakan = selectedOption.getAttribute('data-kode');
            var namaCetakan = selectedOption.getAttribute('data-nama');
            var harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            var satuan = selectedOption.getAttribute('data-satuan');

            // Mengisi nilai pada input terkait
            document.querySelector('.kode-cetakan').value = kodeCetakan;
            document.querySelector('.jenis-cetakan').value = namaCetakan;
            document.querySelector('.harga').value = harga;
            document.querySelector('.satuan').value = satuan;


            // Reset input uang muka dan sisa pembayaran
            resetPaymentFields();
            resetJumlahInput();


            // Memeriksa apakah jenis bahan adalah "banner"
            if (namaCetakan.toLowerCase() === 'banner') {
                showUkuranInputs(); // Menampilkan input ukuran jika jenis bahan adalah banner
                hideJumlahInput(); // Menyembunyikan input jumlah jika jenis bahan adalah banner
            } else {
                hideUkuranInputs(); // Menyembunyikan input ukuran jika jenis bahan bukan banner
                showJumlahInput(); // Menampilkan input jumlah jika jenis bahan bukan banner
                resetCustomDimensions(); // Reset input ukuran
            }
        });

        // Event listener untuk input jumlah
        document.querySelector('.jumlah').addEventListener('input', calculateTotal);

        // Event listener untuk dropdown ukuran
        document.querySelector('.ukuran-dropdown').addEventListener('change', function() {
            var selectedOption = this.value;
            if (selectedOption === 'Custom') {
                showCustomUkuranInputs(); // Menampilkan input panjang dan lebar untuk custom ukuran
            } else {
                hideCustomUkuranInputs(); // Menyembunyikan input panjang dan lebar
            }
        });

        // Event listener untuk input panjang dan lebar
        document.querySelector('.panjang').addEventListener('input', updateCustomUkuran);
        document.querySelector('.lebar').addEventListener('input', updateCustomUkuran);
        document.querySelector('.jumlah_banner').addEventListener('input', updateTotalHarga);

        // Event listener untuk input uang muka
        document.getElementById('uang_muka').addEventListener('input', updateSisaPembayaran);
    });

    function updateTotalHarga() {
        // Get the initial value of total_harga
        var currentHarga = parseFloat(document.querySelector('.total_harga').value) || 0;
        var currentJumlahBanner = parseFloat(document.querySelector('.jumlah_banner').value) || 0;

        document.querySelector('.total_harga').value = (currentHarga * currentJumlahBanner).toFixed(2);

        if (!currentJumlahBanner) {
            updateCustomUkuran()
        }
    }

    function initializeOrderCounter() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();
        var todayString = yyyy + '-' + mm + '-' + dd;

        var storedDate = localStorage.getItem('orderDate');
        if (storedDate !== todayString) {
            localStorage.setItem('orderDate', todayString);
            localStorage.setItem('orderCounter', '1');
        }
    }

    function generateNoNota() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();

        var orderCounter = parseInt(localStorage.getItem('orderCounter'), 10);
        var noNota = 'PM' + yyyy + mm + dd + '-' + orderCounter.toString().padStart(3, '0');
        document.getElementById('noNota').value = noNota;

        localStorage.setItem('orderCounter', (orderCounter + 1).toString());
    }

    function setTodayAsMinDate() {
        var today = new Date();
        var yyyy = today.getFullYear();
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var dd = String(today.getDate()).padStart(2, '0');

        var todayString = yyyy + '-' + mm + '-' + dd;
        document.getElementById('tanggalPesanan').setAttribute('min', todayString);
        document.getElementById('tanggalPesanan').value = todayString;
        var tanggalSelesai = document.getElementById('tanggalSelesai');
        tanggalSelesai.setAttribute('min', todayString);
        tanggalSelesai.value = '';
    }

    function resetCustomDimensions() {
        document.querySelector('.panjang').value = '';
        document.querySelector('.lebar').value = '';
    }

    function resetTotalHarga() {
        document.querySelector('.total_harga').value = '';
    }

    function updateCustomUkuran() {
        var panjang = parseFloat(document.querySelector('.panjang').value) || 0;
        var lebar = parseFloat(document.querySelector('.lebar').value) || 0;
        var jumlah_banner = parseFloat(document.querySelector('.jumlah_banner').value) || 0;
        var harga = parseFloat(document.querySelector('.harga').value) || 0;

        var subtotalUkuran = panjang * lebar;
        var subtotalHarga = subtotalUkuran * harga;

        if (panjang > 0 && lebar > 0) {
            var totalHarga = subtotalHarga;
            document.querySelector('.total_harga').value = totalHarga.toFixed(
                2); // Menyimpan total harga dengan 2 desimal
        }
    }

    function updateUkuranDropdown(text) {
        var dropdown = document.querySelector('.ukuran-dropdown');
        var customOption = Array.from(dropdown.options).find(option => option.value === 'Custom');
        if (customOption) {
            customOption.text = text;
            customOption.value = text;
        }
    }

    function updateDetailFields() {
        var selectedOption = document.querySelector('.nama-bahan-dropdown option:checked');
        document.getElementById('kodeCetakan').value = selectedOption.getAttribute('data-kode');
        document.getElementById('jenisCetakan').value = selectedOption.getAttribute('data-nama');
        document.getElementById('hargaCetakan').value = selectedOption.getAttribute('data-harga');
        document.getElementById('satuan').value = selectedOption.getAttribute('data-satuan');
        document.getElementById('ukuran').value = document.querySelector('.ukuran-dropdown').value;
        document.getElementById('panjang').value = document.querySelector('.panjang').value;
        document.getElementById('lebar').value = document.querySelector('.lebar').value;
        document.getElementById('jumlahBanner').value = document.querySelector('.jumlah_banner').value;
    }

    function showCustomUkuranInputs() {
        // Menampilkan input panjang dan lebar untuk custom ukuran
        document.querySelectorAll('.custom-dimension-inputs').forEach(function(inputGroup) {
            inputGroup.style.display = 'block';
        });
    }

    function hideCustomUkuranInputs() {
        // Menyembunyikan input panjang dan lebar untuk custom ukuran
        document.querySelectorAll('.custom-dimension-inputs').forEach(function(inputGroup) {
            inputGroup.style.display = 'none';
        });
    }

    function showUkuranInputs() {
        // Menampilkan dropdown ukuran
        document.querySelector('.ukuran-group').style.display = 'block';
    }

    function resetJumlahInput() {
        document.querySelector('.jumlah').value = '';
        document.querySelector('.jumlah_banner').value = '';
    }


    function hideUkuranInputs() {
        // Menyembunyikan dropdown ukuran dan input panjang & lebar
        document.querySelector('.ukuran-group').style.display = 'none';
        hideCustomUkuranInputs();
    }

    function showJumlahInput() {
        // Menampilkan input jumlah
        document.querySelector('.jumlah-group').style.display = 'block';
    }

    function hideJumlahInput() {
        // Menyembunyikan input jumlah
        document.querySelector('.jumlah-group').style.display = 'none';
    }

    function calculateTotal() {
        var jumlah = parseFloat(document.querySelector('.jumlah').value) || 0;
        var harga = parseFloat(document.querySelector('.harga').value) || 0;

        var totalHarga = jumlah * harga;
        document.querySelector('.total_harga').value = totalHarga.toFixed(2); // Menyimpan total harga dengan 2 desimal
    }

    function updateSisaPembayaran() {
        var totalHarga = parseFloat(document.querySelector('.total_harga').value) || 0;
        var uangMuka = parseFloat(document.getElementById('uang_muka').value) || 0;

        var sisaPembayaran = totalHarga - uangMuka;
        document.getElementById('sisa_pembayaran').value = sisaPembayaran.toFixed(
            2); // Menyimpan sisa pembayaran dengan 2 desimal
    }

    function resetPaymentFields() {
        document.getElementById('uang_muka').value = '';
        document.getElementById('sisa_pembayaran').value = '';
    }
</script>