<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InformasiLowongan;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [

            [
                'pemberi_informasi_id' => 2,
                'judul_lowongan' => 'UI/UX',
                'perusahaan' => 'Technolgy System',
                'salary' => '1.200.000',
                'bidang' => 'Desainer UI/UX',
                'jenis_lowongan' => 'Full time',
                'pendidikan' => 'SMK - S1',
                'pengalaman' => '0-1 Tahun',
                'keterampilan' => 'Figma, Adobe Ilustrator dan sejenisnya',
                'deskripsi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad illum aperiam cum quasi impedit dolorum reiciendis suscipit obcaecati, ex temporibus est dicta totam, cumque sint fuga, ratione ullam. Laboriosam, recusandae.',
                'verifikasi' => 0,
                'lokasi' => 'Jl. Ujung Gurun No.7, Ujung Gurun, Padang Barat, Padang City, West Sumatra',
                'foto_lowongan' => 'default.jpg',
            ],
            [
                'pemberi_informasi_id' => 4,
                'judul_lowongan' => 'Back End Developer',
                'perusahaan' => 'Tech Tecnology',
                'salary' => '1.200.000',
                'bidang' => 'Programmer',
                'jenis_lowongan' => 'Full time',
                'pendidikan' => 'SMK - S1',
                'pengalaman' => '0-1 Tahun',
                'keterampilan' => 'PHP, MySQL, Framework (Laravel/Codeiginter)',
                'deskripsi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad illum aperiam cum quasi impedit dolorum reiciendis suscipit obcaecati, ex temporibus est dicta totam, cumque sint fuga, ratione ullam. Laboriosam, recusandae.',
                'verifikasi' => 0,
                'lokasi' => 'Jl. Ujung Gurun No.7, Ujung Gurun, Jakarta Barat',
                'foto_lowongan' => 'default.jpg',
            ],
        ];

        foreach ($user as $key => $value) {
        InformasiLowongan::create($value);
        }
    }
}
