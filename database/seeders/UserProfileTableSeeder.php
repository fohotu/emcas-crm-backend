<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserProfileTableSeeder extends Seeder
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
                'full_name'=>'Eldor Dusenov',
                'user_id'=>1,
                'job_title'=>'Injiner',
                'photo'=>"",
            ],
            [
                'full_name'=>'Xasan Xamidov',
                'user_id'=>2,
                'job_title'=>'Injiner',
                'photo'=>"",


            ],
            [
                'full_name'=>'sultanov Ulugbek',
                'user_id'=>3,
                'job_title'=>'Injiner',
                'photo'=>"",


            ],
            [
                'full_name'=>'Qurbanov Ulugbek',
                'user_id'=>4,
                'job_title'=>'Injiner',
                'photo'=>"",


            ],
            [
                'full_name'=>'Zokirjonov Eldor',
                'user_id'=>5,
                'job_title'=>'Injiner',
                'photo'=>"",


            ],
            [
                'full_name'=>'Zusanov Zokir',
                'user_id'=>6,
                'job_title'=>'Injiner',
                'photo'=>"",


            ],

        ];

        Db::table('user_profile')->insert($data);
    }
}
