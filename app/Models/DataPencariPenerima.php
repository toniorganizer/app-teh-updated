<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPencariPenerima extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_disnaker',
        'tgl_1',
        'tgl_2',
        'nmr',
        'judul',
        'type',
        'akll',
        'aklp',
        'akadl',
        'akadp',
        'akanl',
        'akanp',
        'jmll',
        'jmlp',
    ];
}
