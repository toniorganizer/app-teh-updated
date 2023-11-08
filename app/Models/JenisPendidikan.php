<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_disnaker',
        'tgl_1',
        'tgl_2',
        'nmr',
        'judul',
        'sisa_l',
        'sisa_p',
        'terdaftar_l',
        'terdaftar_p',
        'penempatan_l',
        'penempatan_p',
        'hapus_l',
        'hapus_p',
        'akhir_l',
        'akhir_p',
    ];
}
