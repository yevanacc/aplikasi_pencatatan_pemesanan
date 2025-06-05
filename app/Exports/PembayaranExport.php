<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromCollection, WithHeadings
{
    protected $year;
    protected $month;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function collection()
    {
        return Pembayaran::whereYear('created_at', $this->year)
                         ->whereMonth('created_at', $this->month)
                         ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'No Pembayaran',
            'Tanggal Pembayaran',
            // <!-- 'Tanggal Selesai', -->
            'Total Harga',
            'Jumlah Pembayaran',
            // Tambahkan kolom lain sesuai kebutuhan
        ];
    }
}
