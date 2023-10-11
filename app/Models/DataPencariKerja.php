<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPencariKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'pencari_kerja',
        'kelompok_umur',
        '15_L',
        '15_P',
        '20_L',
        '20_P',
        '30_L',
        '30_P',
        '45_L',
        '45_P',
        '55_L',
        '55_P',
        'lowongan_L',
        'lowongan_P',
        'jml'
    ];
}
