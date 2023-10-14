<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPencariKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_disnaker',
        'tgl_1',
        'tgl_2',
        'pencari_kerja',
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
        'lowongan',
        'lowongan_L',
        'lowongan_P'
    ];
}
