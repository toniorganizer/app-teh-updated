<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PencariKerja;

class PencariSeeder extends Seeder
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
                'nama_lengkap' => 'Pemerintah',
                'email_pk' => 'pemangku@gmail.com',
                'alamat' => 'perkembangan',
                'pendidikan' => 'SMK',
                'keterampilan' => 'Rekayasa Perangkat Lunak',
                'foto' => 'image.jpg',
            ]
        ];

        foreach ($user as $key => $value) {
            PencariKerja::create($value);
        }
    }
}
