<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPencariKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_disnaker',
        'nmr',
        'tgl_1',
        'tgl_2',
        'type',
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
        'L',
        'P',
        'jml',
        'lowongan',
        'lowongan_L',
        'lowongan_P',
        'jml_lowongan'
    ];
}
