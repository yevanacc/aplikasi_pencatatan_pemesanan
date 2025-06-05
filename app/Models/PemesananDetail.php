<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    protected $fillable = [
        'pemesanan_id',
        'nama_bahan',
        'kode_cetakan',
        'jenis_cetakan',
        'harga_cetakan',
        'satuan',
        'ukuran',
        'panjang',
        'lebar',
        'jumlah_banner',
    ];
    
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    // public function jenis_cetakan()
    // {
    //     return $this->belongsTo(JenisCetakan::class, 'jenis_cetakan_id');
    // }

}
