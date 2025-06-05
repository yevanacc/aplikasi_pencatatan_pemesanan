<?php

namespace App\Http\Controllers;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Cetakan;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Notifications\UpdatePemesananSelesaiNotification;
use App\Models\User;

class PemesananProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesanans = Pemesanan::all();
        $pemesananDetail = PemesananDetail::all();
        return view('produksi.pemesanan.show', compact('pemesanans', 'pemesananDetail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return view('produksi.pemesanan.edit', compact('pemesanan', 'cetakans', 'pemesananDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            // 'no_nota' => 'required',
            // 'tanggal_pesanan' => 'required|date',
            'tanggal_selesai' => 'required|date',
            // 'nama_pelanggan' => 'required',
            // 'alamat' => 'required',
            // 'no_hp' => 'required',
            // 'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'jumlah' => 'nullable|numeric',
            // 'total_harga' => 'nullable|numeric',
            // 'uang_muka' => 'nullable|numeric',
            // 'sisa_pembayaran' => 'nullable|numeric',
            'status_pesanan' => 'required|string|in:Belum Selesai,Selesai',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        // if ($request->hasFile('image')) {
        //     $ext = $request->image->getClientOriginalExtension();
        //     $rename_file = 'file-' . time() . '.' . $ext;
        //     $request->image->storeAs('public/foto_pemesanan/', $rename_file);
        //     $validateData['image'] = $rename_file;
        // } else {
        //     $validateData['image'] = $pemesanan->image;
        // }

        $pemesanan->update($validateData);

        // Notification::create([
        //     'type' => 'admin', // Notify the admin
        //     'message' => 'Data Pemesanan dengan ID ' . $id . ' telah diperbarui.',
        // ]);

        // $details = [];
        // foreach ($request->nama_bahan as $key => $nama_bahan) {
        //     $details[] = [
        //         'pemesanan_id' => $pemesanan->id,
        //         'nama_bahan' => $nama_bahan,
        //         'kode_cetakan' => $request->kode_cetakan[$key],
        //         'jenis_cetakan' => $request->jenis_cetakan[$key],
        //         'harga_cetakan' => $request->harga_cetakan[$key],
        //         'satuan' => $request->satuan[$key],
        //         'ukuran' => $request->ukuran[$key] ?? null,
        //         'panjang' => $request->panjang[$key] ?? null,
        //         'lebar' => $request->lebar[$key] ?? null,
        //         'jumlah_banner' => $request->jumlah_banner[$key] ?? null,
        //     ];
        // }

        // PemesananDetail::where('pemesanan_id', $pemesanan->id)->delete();
        // PemesananDetail::insert($details);

        $produksiUsers = User::where('role', 'admin')->get();
        foreach ($produksiUsers as $user) {
            $user->notify(new UpdatePemesananSelesaiNotification($pemesanan, 'Pesanan baru telah selesai dibuat!'));
        }

        return redirect()->route('pemesananProduksi.index')->with('success', 'Data Pemesanan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Notification::create([
            'type' => 'admin', // Notify the admin
            'message' => 'Data Pemesanan dengan ID ' . $id . ' telah dihapus.',
        ]);
    }
}
