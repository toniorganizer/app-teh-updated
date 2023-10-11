<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurusan',
        'tahun_lulus',
        'tempat_kerja',
        'status_bekerja',
        'pencari_kerja_id',
        'bkk_id',
    ];
}
