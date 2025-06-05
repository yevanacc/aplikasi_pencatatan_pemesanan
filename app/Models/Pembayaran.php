<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'no_nota',
        'kode_pembayaran',
        'nama_pelanggan',
        'alamat',
        'no_hp',
        'tanggal_pesanan',
        'tanggal_selesai',
        'tanggal_bayar',
        'total_harga',
        'uang_muka',
        'sisa_pembayaran',
        'jumlah_pembayaran',
        'status_pembayaran',
    ];

}
