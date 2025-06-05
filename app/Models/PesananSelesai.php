<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananSelesai extends Model
{
    protected $fillable = ['type', 'message', 'is_read'];
}
