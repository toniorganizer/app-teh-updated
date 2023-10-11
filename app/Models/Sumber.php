<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemberi_informasi_id',
        'pemangku_kepentingan_id',
        'tgl_buka',
        'tgl_tutup',
    ];
}
