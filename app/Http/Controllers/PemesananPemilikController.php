<?php

namespace App\Http\Controllers;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Cetakan;
use Illuminate\Http\Request;

class PemesananPemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesanans = Pemesanan::all();
        return view('pemilik.pemesanan.show', compact('pemesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cetakans = Cetakan::all();
        $pemesananDetails = PemesananDetail::all();
        $bahanList = Cetakan::all();
        // $bahanList = Cetakan::select('id', 'nama_bahan', 'kode_cetakan', 'nama_cetakan', 'harga_cetakan', 'satuan')->get();
        // $bahanList = Cetakan::pluck('nama_bahan');
        // dd($bahanList);
        // $anggota = Anggota::where('ukm_id', $ukm->id)->get();
        return view('pemilik.pemesanan.tambah', compact('cetakans', 'bahanList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no_nota' => 'required',
            'tanggal_pesanan' => 'required|date',
            'tanggal_selesai' => 'nullable|date',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jumlah' => 'nullable|numeric',
            'total_harga' => 'nullable|numeric',
            'uang_muka' => 'nullable|numeric',
            'sisa_pembayaran' => 'nullable|numeric',
            'status_pesanan' => 'required|string|in:Belum Selesai, Selesai',
        ]);

        // dd($validateData);
        if (!$request->filled('tanggal_selesai')) {
            $validateData['tanggal_selesai'] = null;
        }
        // dd('succes');
        //ambil extensi //png / jpg / gif
        $ext = $request->image->getClientOriginalExtension();

        //ubah nama file file
        $rename_file = 'file-' . time() . '.' . $ext;

        //upload foler ke dalam folder public
        $request->image->storeAs('public/foto_pemesanan/', $rename_file);

        $validateData['image'] = $rename_file;

        $pemesanan = Pemesanan::create([
            'no_nota' => $validateData['no_nota'],
            'tanggal_pesanan' => $validateData['tanggal_pesanan'],
            'tanggal_selesai' => $validateData['tanggal_selesai'],
            'nama_pelanggan' => $validateData['nama_pelanggan'],
            'alamat' => $validateData['alamat'],
            'no_hp' => $validateData['no_hp'],
            'image' => $rename_file,
            'jumlah' => $validateData['jumlah'] ?? 0, // Jika null, set ke 0
            'total_harga' => $validateData['total_harga'] ?? 0, // Jika null, set ke 0
            'uang_muka' => $validateData['uang_muka'] ?? 0, // Jika null, set ke 0
            'sisa_pembayaran' => $validateData['sisa_pembayaran'] ?? 0, // Jika null, set ke 0
            'status_pesanan' => $validateData['status_pesanan'],
        ]);

        $details = [];
        foreach ($request->nama_bahan as $key => $nama_bahan) {
            $details[] = [
                'pemesanan_id' => $pemesanan->id,
                'nama_bahan' => $nama_bahan,
                'kode_cetakan' => $request->kode_cetakan[$key],
                'jenis_cetakan' => $request->jenis_cetakan[$key],
                'harga_cetakan' => $request->harga_cetakan[$key],
                'satuan' => $request->satuan[$key],
                'ukuran' => $request->ukuran[$key] ?? null,
                'panjang' => $request->panjang[$key] ?? null,
                'lebar' => $request->lebar[$key] ?? null,
                'jumlah_banner' => $request->jumlah_banner[$key] ?? null,
            ];
        }

        // dd($details);

        // Simpan data detail pemesanan
        PemesananDetail::insert($details);


        return redirect()->route('pemesananPemilik.index')->with('success', 'Data Pemesanan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $cetakans = Cetakan::all();
        $pemesananDetails = $pemesanan->pemesananDetails;
        return view('pemilik.pemesanan.edit', compact('pemesanan', 'cetakans', 'pemesananDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'no_nota' => 'required',
            'tanggal_pesanan' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jumlah' => 'nullable|numeric',
            'total_harga' => 'nullable|numeric',
            'uang_muka' => 'nullable|numeric',
            'sisa_pembayaran' => 'nullable|numeric',
            'status_pesanan' => 'required|string|in:Belum Selesai,Selesai',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        if ($request->hasFile('image')) {
            $ext = $request->image->getClientOriginalExtension();
            $rename_file = 'file-' . time() . '.' . $ext;
            $request->image->storeAs('public/foto_pemesanan/', $rename_file);
            $validateData['image'] = $rename_file;
        } else {
            $validateData['image'] = $pemesanan->image;
        }

        $pemesanan->update($validateData);

        $details = [];
        foreach ($request->nama_bahan as $key => $nama_bahan) {
            $details[] = [
                'pemesanan_id' => $pemesanan->id,
                'nama_bahan' => $nama_bahan,
                'kode_cetakan' => $request->kode_cetakan[$key],
                'jenis_cetakan' => $request->jenis_cetakan[$key],
                'harga_cetakan' => $request->harga_cetakan[$key],
                'satuan' => $request->satuan[$key],
                'ukuran' => $request->ukuran[$key] ?? null,
                'panjang' => $request->panjang[$key] ?? null,
                'lebar' => $request->lebar[$key] ?? null,
                'jumlah_banner' => $request->jumlah_banner[$key] ?? null,
            ];
        }

        PemesananDetail::where('pemesanan_id', $pemesanan->id)->delete();
        PemesananDetail::insert($details);

        return redirect()->route('pemesananPemilik.index')->with('success', 'Data Pemesanan Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->pemesananDetails()->delete();
        $pemesanan->delete();
        return redirect()->route('pemesananPemilik.index')->with('success', 'Data Pemesanan Berhasil Dihapus');
    }
}
