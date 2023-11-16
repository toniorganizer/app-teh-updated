<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelompokJabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_disnaker',
        'tgl_1',
        'tgl_2',
        'nmr',
        'judul_kj',
        'sisa_l_kj',
        'sisa_p_kj',
        'terdaftar_l_kj',
        'terdaftar_p_kj',
        'penempatan_l_kj',
        'penempatan_p_kj',
        'hapus_l_kj',
        'hapus_p_kj',
        'akhir_l_kj',
        'akhir_p_kj',
    ];
}
