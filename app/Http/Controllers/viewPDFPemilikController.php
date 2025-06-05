<?php

namespace App\Http\Controllers;
use Dompdf\Dompdf;
use App\Models\Pemesanan;
use App\Models\Pembayaran;

class viewPDFPemilikController extends Controller
{
    public function generatePemesananPDF($year, $month)
    {
        // Fetch data for the Pemesanan report
        $pemesananDetails = Pemesanan::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $data = [
            'year' => $year,
            'month' => $month,
            'pemesananDetails' => $pemesananDetails
        ];

        // Load HTML content
        $html = view('admin.laporan.viewPDF', $data)->render();

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
        $pembayaranDetails = Pembayaran::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $data = [
            'year' => $year,
            'month' => $month,
            'pembayaranDetails' => $pembayaranDetails
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
}
