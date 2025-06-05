<?php

namespace App\Http\Controllers;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\PemesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesananFilterLaporan = Pemesanan::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $pembayaranFilterLaporan = Pembayaran::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        
        return view('pemilik.laporan.tampilan', compact('pemesananFilterLaporan', 'pembayaranFilterLaporan'));
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
    public function showPemesanan($year, $month)
    {
        $pemesananDetails = DB::table('pemesanan_details')
        ->join('pemesanans', 'pemesanan_details.pemesanan_id', '=', 'pemesanans.id')
        ->select(
            'pemesanans.no_nota',
            'pemesanans.nama_pelanggan',
            'pemesanan_details.jenis_cetakan', // Mengambil jenis_cetakan dari pemesanan_detail
            'pemesanans.tanggal_pesanan',
            'pemesanans.tanggal_selesai',
            'pemesanans.total_harga'
        )
        ->whereYear('pemesanans.created_at', $year)
        ->whereMonth('pemesanans.created_at', $month)
        ->get();

        return view('pemilik.laporan.showPemesananPemilik', compact('pemesananDetails', 'year', 'month'));
    }

    public function showPembayaran($year, $month)
    {
        $pembayaranDetails = Pembayaran::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        return view('pemilik.laporan.showPembayaranPemilik', compact('pembayaranDetails', 'year', 'month'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
