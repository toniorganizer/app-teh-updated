<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_age',
        'end_age',
        'male_count_terdaftar',
        'female_count_terdaftar',
    ];
}
