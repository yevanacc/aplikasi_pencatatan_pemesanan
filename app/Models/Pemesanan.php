<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = ['no_nota', 'tanggal_pesanan', 'tanggal_selesai', 'nama_pelanggan', 'alamat', 'no_hp', 'image', 'jumlah', 'total_harga', 'uang_muka', 'sisa_pembayaran', 'status_pesanan'];

    public function pemesananDetails()
    {
        return $this->hasMany(PemesananDetail::class);
    }

    // public function pemesananDetail()
    // {
    //     return $this->hasMany(PemesananDetail::class, 'id_pemesanan', 'id');
    // }
}
