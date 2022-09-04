<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[

            [
                'email' => 'eldor@mail.l',
                'password' => Hash::make('123'),
                'role' => 'admin'
            ],
            [
                'email' => 'xasan@mail.l',
                'password' => Hash::make('123'),
                'role' => 'user'

            ],
            [
                'email' => 'sultanov@mail.l',
                'password' => Hash::make('123'),
                'role' => 'user'
            ],
            [
                'email' => 'qurbanov@mail.l',
                'password' => Hash::make('123'),
                'role' => 'user'
            ],
            [
                'email' => 'zokirjonov@mail.l',
                'password' => Hash::make('123'),
                'role' => 'user'
            ],
            [
                'email' => 'xusanov@mail.l',
                'password' => Hash::make('123'),
                'role' => 'user'
            ],

        ];

        Db::table('users')->insert($data);
    }
}
