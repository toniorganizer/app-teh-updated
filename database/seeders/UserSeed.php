<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
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
                'name' => 'Disdik',
                'username' => 'disdik_sumbar',
                'email' => 'pemangku@gmail.com',
                'password' => bcrypt('123456'),
                'level' => 3,
                'foto_user' => 'default.jpg',
            ],
            [
                'name' => 'Admin',
                'username' => 'admin_sipk',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin_sipk'),
                'level' => 1,
                'foto_user' => 'default.jpg',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
