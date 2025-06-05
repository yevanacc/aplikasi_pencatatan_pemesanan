@extends('dashboard')
@section('content')
    <div class="container">
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <div class="card shadow m-4 col-9 mx-auto">
            <div class="card-header py-3">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-0">
                    <a href="{{ route('jenisCetakanPemilik.create') }}" class="btn btn-auto  btn-primary shadow-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-square"></i>
                        </span>
                        <span class="text">Tambah Jenis Cetakan</span>
                    </a>

                </div>
            </div>

            <div class="card-body py-3">
                <h1>Data Jenis Cetakan</h1>
                <div class="d-sm-flex align-items-center justify-content-between mb-0">

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Bahan</th>
                                    <th scope="col">Kode Cetakan</th>
                                    <th scope="col">Nama Cetakan</th>
                                    <th scope="col">Harga Cetakan</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cetakans as $index => $cetakan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $cetakan->nama_bahan }}</td>
                                        <td>{{ $cetakan->kode_cetakan }}</td>
                                        <td>{{ $cetakan->nama_cetakan }}</td>
                                        <td>{{ $cetakan->harga_cetakan }}</td>
                                        <td>{{ $cetakan->satuan }}</td>
                                        <td>
                                            <a href="{{ route('jenisCetakanPemilik.edit', $cetakan->id) }}"
                                                class="btn btn-primary mb-2">Edit</a>
                                            <form action="{{ route('jenisCetakanPemilik.destroy', $cetakan->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Jenis Cetakan Belum Tersedia.
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
