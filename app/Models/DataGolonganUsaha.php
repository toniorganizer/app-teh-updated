<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGolonganUsaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_disnaker',
        'tgl_1',
        'tgl_2',
        'nmr',
        'judul_gu',
        'sisa_l_gu',
        'sisa_p_gu',
        'terdaftar_l_gu',
        'terdaftar_p_gu',
        'penempatan_l_gu',
        'penempatan_p_gu',
        'hapus_l_gu',
        'hapus_p_gu',
        'akhir_l_gu',
        'akhir_p_gu',
    ];
}
