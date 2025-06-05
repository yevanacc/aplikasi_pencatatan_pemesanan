<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function generatePemesananPDF($year, $month)
    {
        // Fetch data for the Pemesanan report
        $pemesananDetails = DB::table('pemesanan_details')
            ->join('pemesanans', 'pemesanan_details.pemesanan_id', '=', 'pemesanans.id')
            ->select(
                'pemesanans.no_nota',
                'pemesanans.nama_pelanggan',
                'pemesanan_details.jenis_cetakan', // Pastikan jenis_cetakan diambil
                'pemesanans.tanggal_pesanan',
                'pemesanans.tanggal_selesai',
                'pemesanans.total_harga',
            )
            ->whereYear('pemesanans.created_at', $year)
            ->whereMonth('pemesanans.created_at', $month)
            ->get();

        $data = [
            'year' => $year,
            'month' => $month,
            'pemesananDetails' => $pemesananDetails,
        ];

        // Load HTML content
        $html = view('admin.laporan.viewPDF', $data)->render();

        // Debug HTML to ensure correct data
        // dd($html); // Uncomment to debug

        // Instantiate Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF to browser
        return $dompdf->stream('Laporan_Bulanan_Pemesanan.pdf');
    }

    public function generatePembayaranPDF($year, $month)
    {
        // Fetch data for the Pembayaran report
        $pembayaranDetails = Pembayaran::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();

        $data = [
            'year' => $year,
            'month' => $month,
            'pembayaranDetails' => $pembayaranDetails,
        ];

        // Load HTML content
        $html = view('admin.laporan.viewPDFPembayaran', $data)->render();

        // Instantiate Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF to browser
        return $dompdf->stream('Laporan_Bulanan_Pembayaran.pdf');
    }

    public function generateNotaPemesananPDF($id)
    {
        $pemesananDetails = DB::table('pemesanan_details')
            ->join('pemesanans', 'pemesanan_details.pemesanan_id', '=', 'pemesanans.id')
            ->select(
                'pemesanans.no_nota',
                'pemesanans.tanggal_pesanan',
                'pemesanans.tanggal_selesai',
                'pemesanans.nama_pelanggan',
                'pemesanan_details.jenis_cetakan',
                'pemesanan_details.jumlah_banner', // Pastikan kolom ini ada
                'pemesanans.jumlah', // Pastikan kolom ini ada
                'pemesanans.total_harga',
                'pemesanans.uang_muka',
                'pemesanans.sisa_pembayaran',
            )
            ->where('pemesanans.id', $id)
            ->first();

        // Konversi gambar menjadi base64
        $path = public_path('img/indo_media.jpeg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $data = [
            'pemesananDetails' => $pemesananDetails,
            'logo_base64' => $base64,
        ];

        // Load HTML content
        $html = view('admin.pemesanan.nota', $data)->render();

        // Instantiate Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Set custom paper size (80mm x 297mm)
        $paperWidth = 80 / 25.4; // Convert mm to inches
        $paperHeight = 200 / 25.4; // Convert mm to inches
        $dompdf->setPaper([0, 0, $paperWidth * 72, $paperHeight * 72]); // 72 dpi

        // Render PDF
        $dompdf->render();

        // Output PDF to browser
        return $dompdf->stream('Nota_Pemesanan');
    }
}
