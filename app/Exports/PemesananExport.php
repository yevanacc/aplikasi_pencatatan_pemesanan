<?php

namespace App\Exports;

use App\Models\Pemesanan;


class PemesananExport implements FromCollection, WithHeadings
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
        return Pemesanan::whereYear('created_at', $this->year)
                        ->whereMonth('created_at', $this->month)
                        ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'No Nota',
            'Nama Pelanggan',
            'Tanggal Pemesanan',
            'Tanggal Selesai',
            // Tambahkan kolom lain sesuai kebutuhan
        ];
    }
}


