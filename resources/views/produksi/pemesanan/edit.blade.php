@extends('layout.masterProduksi')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7 mx-auto">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h1>Edit Pemesanan</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemesananProduksi.update', $pemesanan->id) }}" method="POST"
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
                                    @if ($pemesanan->tanggal_selesai)
                                        <input type="date" id="tanggalSelesai" class="form-control"
                                            name="tanggal_selesai" value="{{ $pemesanan->tanggal_selesai }}" readonly>
                                    @else
                                        <input type="date" id="tanggalSelesai"
                                            class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                            name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                                    @endif
                                    @error('tanggal_selesai')
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
                                            {{ $pemesanan->status_pesanan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    @error('status_pesanan')
                                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                                <a href="{{ route('pemesananProduksi.index') }}" class="btn btn-secondary mt-3">Cancel</a>
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
        setTodayAsMinDate();
    });

    function setTodayAsMinDate() {
        var today = new Date();
        var yyyy = today.getFullYear();
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var dd = String(today.getDate()).padStart(2, '0');

        var todayString = yyyy + '-' + mm + '-' + dd;
        var tanggalSelesai = document.getElementById('tanggalSelesai');

        @if ($pemesanan->tanggal_selesai)
            tanggalSelesai.setAttribute('readonly', 'readonly');
        @else
            tanggalSelesai.setAttribute('min', todayString);
            tanggalSelesai.value = todayString;
        @endif
    }
</script>
