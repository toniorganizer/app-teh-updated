<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLowonganPendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_disnaker',
        'tgl_1',
        'tgl_2',
        'nmr',
        'judul_lp',
        'sisa_l_lp',
        'sisa_p_lp',
        'terdaftar_l_lp',
        'terdaftar_p_lp',
        'penempatan_l_lp',
        'penempatan_p_lp',
        'hapus_l_lp',
        'hapus_p_lp',
        'akhir_l_lp',
        'akhir_p_lp',
    ];
}
