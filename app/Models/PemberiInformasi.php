<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemberiInformasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_instansi',
        'bidang_instansi',
        'email_instansi',
        'website_instansi',
        'instagram_instansi',
        'facebook_instansi',
        'telepon_instansi',
        'alamat',
        'deskripsi',
        'foto_instansi',
    ];
}
