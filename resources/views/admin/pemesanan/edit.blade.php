@extends('layout.masterAdmin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7 mx-auto">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h1>Edit Pemesanan</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body" style="display: flex; flex-direction: column;">
                                <div class="mb-1">
                                    <label for="no_nota" class="form-label">No Nota</label>
                                    <input type="text" id="noNota"
                                        class="form-control @error('no_nota') is-invalid @enderror" name="no_nota"
                                        value="{{ $pemesanan->no_nota }}" required readonly>
                                    @error('no_nota')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="tanggal_pesanan" class="form-label">Tanggal Pesanan</label>
                                    <input type="date" id="tanggalPesanan"
                                        class="form-control @error('tanggal_pesanan') is-invalid @enderror"
                                        name="tanggal_pesanan" value="{{ $pemesanan->tanggal_pesanan }}" required readonly>
                                    @error('tanggal_pesanan')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" id="tanggalSelesai"
                                        class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                        name="tanggal_selesai" value="{{ $pemesanan->tanggal_selesai }}" required>
                                    @error('tanggal_selesai')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                    <input type="text" id="namaPelanggan"
                                        class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                        name="nama_pelanggan" value="{{ $pemesanan->nama_pelanggan }}" required readonly>
                                    @error('nama_pelanggan')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required readonly>{{ $pemesanan->alamat }}</textarea>
                                    @error('alamat')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" id="noHp"
                                        class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                        value="{{ $pemesanan->no_hp }}" required readonly>
                                    @error('no_hp')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" id="image"
                                        class="form-control @error('image') is-invalid @enderror" name="image" required
                                        readonly>
                                    @error('image')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                    <img src="{{ asset('storage/foto_pemesanan/' . $pemesanan->image) }}" alt="Image"
                                        style="width: 100px; height: 100px;">
                                </div>

                                <div class="mb-1">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" id="jumlah"
                                        class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                                        value="{{ $pemesanan->jumlah }}" required readonly>
                                    @error('jumlah')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" id="totalHarga"
                                        class="form-control @error('total_harga') is-invalid @enderror" name="total_harga"
                                        value="{{ $pemesanan->total_harga }}" required>
                                    @error('total_harga')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="uang_muka" class="form-label">Uang Muka</label>
                                    <input type="number" id="uangMuka"
                                        class="form-control @error('uang_muka') is-invalid @enderror" name="uang_muka"
                                        value="{{ $pemesanan->uang_muka }}" required readonly>
                                    @error('uang_muka')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="sisa_pembayaran" class="form-label">Sisa Pembayaran</label>
                                    <input type="number" id="sisaPembayaran"
                                        class="form-control @error('sisa_pembayaran') is-invalid @enderror"
                                        name="sisa_pembayaran" value="{{ $pemesanan->sisa_pembayaran }}" required>
                                    @error('sisa_pembayaran')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="status_pesanan" class="form-label">Status Pesanan</label>
                                    <select id="statusPesanan"
                                        class="form-control @error('status_pesanan') is-invalid @enderror"
                                        name="status_pesanan" required>
                                        <option value="Belum Selesai"
                                            {{ $pemesanan->status_pesanan == 'Belum Selesai' ? 'selected' : '' }}>Belum
                                            Selesai</option>
                                        <option value="Selesai"
                                            {{ $pemesanan->status_pesanan == 'Selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                    </select>
                                    @error('status_pesanan')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="card-header py-3">
                                    <h1>Edit Pemesanan Detail</h1>
                                </div>

                                @foreach ($pemesananDetails as $key => $pemesananDetail)
                                    <div class="mb-1">
                                        <label for="nama_bahan_{{ $key }}" class="form-label">Nama Bahan</label>
                                        <input type="text" id="nama_bahan_{{ $key }}"
                                            class="form-control @error('nama_bahan.*') is-invalid @enderror"
                                            name="nama_bahan[]" value="{{ $pemesananDetail->nama_bahan }}" required
                                            readonly>
                                        @error('nama_bahan.*')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <label for="kode_cetakan_{{ $key }}" class="form-label">Kode
                                            Cetakan</label>
                                        <input type="text" id="kode_cetakan_{{ $key }}"
                                            class="form-control @error('kode_cetakan.*') is-invalid @enderror"
                                            name="kode_cetakan[]" value="{{ $pemesananDetail->kode_cetakan }}" required
                                            readonly>
                                        @error('kode_cetakan.*')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <label for="jenis_cetakan_{{ $key }}" class="form-label">Jenis
                                            Cetakan</label>
                                        <input type="text" id="jenis_cetakan_{{ $key }}"
                                            class="form-control @error('jenis_cetakan.*') is-invalid @enderror"
                                            name="jenis_cetakan[]" value="{{ $pemesananDetail->jenis_cetakan }}" required
                                            readonly onchange="toggleReadonly(this, {{ $key }})">
                                        @error('jenis_cetakan.*')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <label for="harga_cetakan_{{ $key }}" class="form-label">Harga
                                            Cetakan</label>
                                        <input type="number" id="harga_cetakan_{{ $key }}"
                                            class="form-control @error('harga_cetakan.*') is-invalid @enderror"
                                            name="harga_cetakan[]" value="{{ $pemesananDetail->harga_cetakan }}" required
                                            readonly>
                                        @error('harga_cetakan.*')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <label for="satuan_{{ $key }}" class="form-label">Satuan</label>
                                        <input type="text" id="satuan_{{ $key }}"
                                            class="form-control @error('satuan.*') is-invalid @enderror" name="satuan[]"
                                            value="{{ $pemesananDetail->satuan }}" required readonly>
                                        @error('satuan.*')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <label for="ukuran_{{ $key }}" class="form-label">Ukuran</label>
                                        <input type="text" id="ukuran_{{ $key }}"
                                            class="form-control @error('ukuran.*') is-invalid @enderror" name="ukuran[]"
                                            value="{{ $pemesananDetail->ukuran }}" readonly>
                                        @error('ukuran.*')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <label for="panjang_{{ $key }}" class="form-label">Panjang</label>
                                        <input type="number" id="panjang_{{ $key }}"
                                            class="form-control @error('panjang.*') is-invalid @enderror"
                                            name="panjang[]" value="{{ $pemesananDetail->panjang }}" readonly>
                                        @error('panjang.*')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <label for="lebar_{{ $key }}" class="form-label">Lebar</label>
                                        <input type="number" id="lebar_{{ $key }}"
                                            class="form-control @error('lebar.*') is-invalid @enderror" name="lebar[]"
                                            value="{{ $pemesananDetail->lebar }}" readonly>
                                        @error('lebar.*')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <label for="jumlah_banner_{{ $key }}" class="form-label">Jumlah
                                            Banner</label>
                                        <input type="number" id="jumlah_banner_{{ $key }}"
                                            class="form-control @error('jumlah_banner.*') is-invalid @enderror"
                                            name="jumlah_banner[]" value="{{ $pemesananDetail->jumlah_banner }}"
                                            readonly>
                                        @error('jumlah_banner.*')
                                            <div class="text-danger"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                                <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function toggleReadonly(element, key) {
        let jenisCetakan = element.value;
        let ukuran = document.getElementById('ukuran_' + key);
        let panjang = document.getElementById('panjang_' + key);
        let lebar = document.getElementById('lebar_' + key);
        let jumlahBanner = document.getElementById('jumlah_banner_' + key);

        if (jenisCetakan.toLowerCase() === 'banner') {
            ukuran.removeAttribute('readonly');
            panjang.removeAttribute('readonly');
            lebar.removeAttribute('readonly');
            jumlahBanner.removeAttribute('readonly');
        } else {
            ukuran.setAttribute('readonly', true);
            panjang.setAttribute('readonly', true);
            lebar.setAttribute('readonly', true);
            jumlahBanner.setAttribute('readonly', true);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        let jenisCetakanElements = document.querySelectorAll('input[id^="jenis_cetakan_"]');
        jenisCetakanElements.forEach((element, index) => {
            toggleReadonly(element, index);
        });
    });
</script>
