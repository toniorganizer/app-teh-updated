<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLowonganJabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_disnaker',
        'tgl_1',
        'tgl_2',
        'nmr',
        'judul_lj',
        'type',
        'sisa_l_lj',
        'sisa_p_lj',
        'terdaftar_l_lj',
        'terdaftar_p_lj',
        'penempatan_l_lj',
        'penempatan_p_lj',
        'hapus_l_lj',
        'hapus_p_lj',
        'akhir_l_lj',
        'akhir_p_lj',
    ];
}
