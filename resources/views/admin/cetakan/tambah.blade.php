@extends('layout.masterAdmin')
@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-xl-8 col-lg-7 mx-auto">
            <div class="card shadow mb-2">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h1>Tambah Jenis Cetakan</h1>
                </div>


                <!-- Card Body -->

                <div class="card-body">
                    <form action="{{ route('jenisCetakan.store') }}" method="POST">
                        @csrf

                        <div class="mb-1">
                            <label for="nama_bahan" class="form-label">Nama Bahan</label> <br>
                            <select name="nama_bahan" class="form-control" required>
                                <option value="-" selected>-</option>
                                <option value="Flexi China">Flexi China</option>
                                <option value="Flexi Korea">Flexi Korea</option>
                                <option value="Flexi Jerman">Flexi Jerman</option>
                                <option value="Albatros">Albatros</option>
                                <option value="Luster">Luster</option>
                                <option value="Glossy Paper">Glossy Paper</option>
                                <option value="Sticker Ritrama">Kertas Sticker Ritrama</option>
                                <option value="Sticker Transparan">Kertas Sticker Transparan</option>
                                <option value="Canvas">Canvas</option>
                                <option value="Sticker Oneway">Kertas Sticker Oneway</option>
                                <option value="HVS">Kertas HVS</option>
                                <option value="A3">Kertas A3</option>
                                <option value="A4">Kertas A4</option>
                                <option value="Art">Kertas Art</option>
                                <option value="Art Karton">Kertas Art Karton</option>
                                <option value="Duplex">Kertas Duplex</option>
                                <option value="Duplex Putih">Kertas Duplex Putih</option>
                            </select>
                        </div>
                        

                            <div class="mb-1">
                                <label for="kode_cetakan" class="form-label">Kode Cetakan</label>
                                <input type="number" class="form-control" name="kode_cetakan" required>
                            </div>

                            <div class="mb-1">
                                <label for="nama_cetakan" class="form-label">Nama Cetakan</label>
                                <input type="text" class="form-control @error('nama_cetakan') is-invalid @enderror"
                                    name="nama_cetakan" required>
                                @error('nama_cetakan')
                                    <div class="text-danger">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="harga_cetakan" class="form-label">Harga Cetakan</label>
                                <input type="number" class="form-control" name="harga_cetakan" required>
                            </div>

                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label> <br>
                                <select name="satuan" class="form-control" required>
                                    <option value="-" selected>-</option>
                                    <option value="Lembar">Lembar</option>
                                    <option value="Meter">Meter</option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-success btn-primary shadow-sm bg-green"
                                style="background-color: green;">Tambah Cetakan</button>

                            <a href="{{ route('jenisCetakan.index') }}"
                                class="btn btn-auto btn-primary shadow-sm">
                                <span class="text">Batal</span>
                            </a>

                            {{-- @if (Auth::user()->ukm)
                                <a href="{{ route('anggota.show', ['id' => Auth::user()->ukm->id]) }}"
                                    class="btn btn-auto btn-primary shadow-sm">
                                    <span class="icon text-black-50">
                                        <i class="fas fa-plus-square"></i>
                                    </span>
                                    <span class="text">Batal</span>
                                </a>
                            @else
                                <!-- Tampilkan pesan atau lakukan tindakan alternatif jika user tidak terkait dengan UKM -->
                                User tidak terkait dengan UKM.
                            @endif --}}
                            <script>
                                function validateForm() {
                                    var npm = document.getElementById('npm').value;
                                    var namaMahasiswa = document.getElementById('namaMahasiswa').value;
                                    var email = document.getElementById('email').value;
                                    var noHp = document.getElementById('noHp').value;
                                    var jabatan = document.getElementById('jabatan').value;
                                    var status = document.getElementById('status').value;

                                    // Lakukan validasi sesuai kebutuhan
                                    if (npm === '' || namaMahasiswa === '' || email === '' || noHp === '' || jabatan === '' || status === '') {
                                        document.getElementById('peringatan').innerText = 'Field Harus Diisi!!';
                                        return false; // Form tidak akan dikirim jika tidak valid
                                    } else {
                                        // Form valid, lanjutkan dengan pengiriman formulir
                                        document.getElementById('peringatan').innerText = '';
                                        return true;
                                    }
                                }
                            </script>


                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


@endsection