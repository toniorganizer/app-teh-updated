<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BursaKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah',
        'email_sekolah',
        'website_sekolah',
        'instagram_sekolah',
        'facebook_sekolah',
        'telepon_sekolah',
        'alamat_sekolah',
        'foto_sekolah',
    ];
}
