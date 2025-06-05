@extends('layout.masterAdmin')
@section('content')
    <div class="container">
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <div class="card shadow m-4">
            <div class="card-header py-3">
                <!-- Page Heading -->
                <h1>Edit Cetakan</h1>
            </div>
            <div class="card-body py-3">
                <form action="{{ route('jenisCetakan.update', $cetakan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_bahan" class="form-label">Nama Bahan</label>
                        <input type="text" class="form-control @error('nama_bahan') is-invalid @enderror" id="nama_bahan" name="nama_bahan" value="{{ old('nama_bahan', $cetakan->nama_bahan) }}" required>
                        @error('nama_bahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kode_cetakan" class="form-label">Kode Cetakan</label>
                        <input type="number" class="form-control @error('kode_cetakan') is-invalid @enderror" id="kode_cetakan" name="kode_cetakan" value="{{ old('kode_cetakan', $cetakan->kode_cetakan) }}" required readonly>
                        @error('kode_cetakan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_cetakan" class="form-label">Nama Cetakan</label>
                        <input type="text" class="form-control @error('nama_cetakan') is-invalid @enderror" id="nama_cetakan" name="nama_cetakan" value="{{ old('nama_cetakan', $cetakan->nama_cetakan) }}" required>
                        @error('nama_cetakan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_cetakan" class="form-label">Harga Cetakan</label>
                        <input type="number" class="form-control @error('harga_cetakan') is-invalid @enderror" id="harga_cetakan" name="harga_cetakan" value="{{ old('harga_cetakan', $cetakan->harga_cetakan) }}" required>
                        @error('harga_cetakan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan', $cetakan->satuan) }}" required>
                        @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('jenisCetakan.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
