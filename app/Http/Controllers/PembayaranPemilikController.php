<?php

namespace App\Http\Controllers;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\PemesananDetail;
use Illuminate\Http\Request;

class PembayaranPemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesanans = Pemesanan::all();
        $details = PemesananDetail::all(); 
        $pembayarans = Pembayaran::all();
        return view('pemilik.pembayaran.show', compact('pemesanans', 'details', 'pembayarans'));
        // return view('admin.pembayaran.show');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        // $pemesanans = Pemesanan::select('id', 'no_nota', 'nama_pelanggan', 'alamat', 'no_hp', 'tanggal_pesanan', 'tanggal_selesai', 'total_harga', 'uang_muka', 'sisa_pembayaran');
        // dd($pemesanans);
        $pemesanans = Pemesanan::all();
        // $details = PemesananDetail::all();
        return view('pemilik.pembayaran.tambah', compact('pemesanans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no_nota' => 'required',
            'kode_pembayaran' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'tanggal_pesanan' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'tanggal_bayar' => 'required|date',
            'total_harga' => 'required|numeric',
            'uang_muka' => 'required|numeric',
            'sisa_pembayaran' => 'required|numeric',
            'jumlah_pembayaran' => 'required|numeric',
            'status_pembayaran' => 'required|in:Belum Lunas,Lunas',
        ]);
        // dd($validateData);
    
        // Simpan data ke dalam model Pembayaran
        Pembayaran::create($validateData);
        return redirect()->route('pembayaranPemilik.index')->with('success', 'Data Pembayaran Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pemilik.pembayaran.edit', compact('pembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'no_nota' => 'required',
            'no_pembayaran' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'tanggal_pesanan' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'tanggal_bayar' => 'required|date',
            'total_harga' => 'required|numeric',
            'uang_muka' => 'required|numeric',
            'sisa_pembayaran' => 'required|numeric',
            'jumlah_pembayaran' => 'required|numeric',
            'status_pembayaran' => 'required|in:Belum Lunas,Lunas',
        ]);

        Pembayaran::whereId($id)->update($validateData);
        return redirect()->route('pembayaranPemilik.index')->with('success', 'Data Pembayaran Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pembayaran::destroy($id);
        return redirect()->route('pembayaranPemilik.index')->with('success', 'Data Pembayaran Berhasil Dihapus');
    }
}
