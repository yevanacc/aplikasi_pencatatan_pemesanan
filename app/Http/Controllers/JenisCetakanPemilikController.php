<?php

namespace App\Http\Controllers;
use App\Models\Cetakan;
use Illuminate\Http\Request;

class JenisCetakanPemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cetakans = Cetakan::all();

        // Mengirim data ke view
        return view('pemilik.cetakan.show', compact('cetakans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemilik.cetakan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_bahan' => 'required|string',
            'kode_cetakan' => 'required|numeric',
            'nama_cetakan' => 'required',
            'harga_cetakan' => 'required|numeric',
            'satuan' => 'required|string',
        ]);

        $cetakan = new Cetakan([
            'nama_bahan' => $validateData['nama_bahan'],
            'kode_cetakan' => $validateData['kode_cetakan'],
            'nama_cetakan' => $validateData['nama_cetakan'],
            'harga_cetakan' => $validateData['harga_cetakan'],
            'satuan' => $validateData['satuan'],
        ]);

        $cetakan->save();

        return redirect()->route('jenisCetakanPemilik.index')->with('success', 'Data Cetakan Berhasil Ditambahkan');

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
        $cetakan = Cetakan::findOrFail($id);
        return view('pemilik.cetakan.edit', compact('cetakan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'nama_bahan' => 'required|string',
            'kode_cetakan' => 'required|numeric',
            'nama_cetakan' => 'required',
            'harga_cetakan' => 'required|numeric',
            'satuan' => 'required|string',
        ]);

        $cetakan = Cetakan::findOrFail($id);
        $cetakan->update($validateData);

        return redirect()->route('jenisCetakanPemilik.index')->with('success', 'Data Cetakan Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cetakan = Cetakan::findOrFail($id);
        $cetakan->delete();

        return redirect()->route('jenisCetakanPemilik.index')->with('success', 'Data Cetakan Berhasil Dihapus');
    }
}
