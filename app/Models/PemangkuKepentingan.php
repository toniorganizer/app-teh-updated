<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemangkuKepentingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lembaga',
        'bidang_lembaga',
        'email_lembaga',
        'status_lembaga',
        'role_acc',
        'id_disnaker_kab',
        'website_lembaga',
        'instagram_lembaga',
        'facebook_lembaga',
        'telepon_lembaga',
        'alamat_lembaga',
        'foto_lembaga',
    ];
}
