<?php

namespace App\Http\Controllers;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\PemesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
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
        
        return view('admin.laporan.tampilan', compact('pemesananFilterLaporan', 'pembayaranFilterLaporan'));
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

        return view('admin.laporan.showPemesanan', compact('pemesananDetails', 'year', 'month'));
    }

    public function showPembayaran($year, $month)
    {
        $pembayaranDetails = Pembayaran::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        return view('admin.laporan.showPembayaran', compact('pembayaranDetails', 'year', 'month'));
    }

    // public function exportPemesanan($year, $month)
    // {
    //     $pemesananDetails = Pemesanan::whereYear('created_at', $year)
    //                                  ->whereMonth('created_at', $month)
    //                                  ->get();

    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $sheet->setCellValue('A1', 'ID');
    //     $sheet->setCellValue('B1', 'Nama Pemesan');
    //     $sheet->setCellValue('C1', 'Tanggal Pemesanan');
    //     $sheet->setCellValue('D1', 'Total Harga');

    //     $row = 2;
    //     foreach ($pemesananDetails as $pemesanan) {
    //         $sheet->setCellValue('A' . $row, $pemesanan->id);
    //         $sheet->setCellValue('B' . $row, $pemesanan->nama_pemesan);
    //         $sheet->setCellValue('C' . $row, $pemesanan->created_at);
    //         $sheet->setCellValue('D' . $row, $pemesanan->total_harga);
    //         $row++;
    //     }

    //     $writer = new Xlsx($spreadsheet);
    //     $fileName = 'laporan_pemesanan_' . $year . '_' . $month . '.xlsx';
    //     $tempFilePath = tempnam(sys_get_temp_dir(), $fileName);
    //     $writer->save($tempFilePath);

    //     return response()->download($tempFilePath, $fileName)->deleteFileAfterSend(true);
    // }

    // public function exportPembayaran($year, $month)
    // {
    //     $pembayaranDetails = Pembayaran::whereYear('created_at', $year)
    //                                    ->whereMonth('created_at', $month)
    //                                    ->get();

    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $sheet->setCellValue('A1', 'ID');
    //     $sheet->setCellValue('B1', 'ID Pemesanan');
    //     $sheet->setCellValue('C1', 'Tanggal Pembayaran');
    //     $sheet->setCellValue('D1', 'Jumlah Pembayaran');

    //     $row = 2;
    //     foreach ($pembayaranDetails as $pembayaran) {
    //         $sheet->setCellValue('A' . $row, $pembayaran->id);
    //         $sheet->setCellValue('B' . $row, $pembayaran->pemesanan_id);
    //         $sheet->setCellValue('C' . $row, $pembayaran->created_at);
    //         $sheet->setCellValue('D' . $row, $pembayaran->jumlah_pembayaran);
    //         $row++;
    //     }

    //     $writer = new Xlsx($spreadsheet);
    //     $fileName = 'laporan_pembayaran_' . $year . '_' . $month . '.xlsx';
    //     $tempFilePath = tempnam(sys_get_temp_dir(), $fileName);
    //     $writer->save($tempFilePath);

    //     return response()->download($tempFilePath, $fileName)->deleteFileAfterSend(true);
    // }

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
