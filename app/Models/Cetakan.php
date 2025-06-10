<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cetakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bahan',
        'kode_cetakan',
        'nama_cetakan',
        'harga_cetakan',
        'satuan'
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'kode_cetakan');
    }
}
