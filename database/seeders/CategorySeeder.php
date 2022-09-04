<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Db::table('category')->insert([
            ['title'=>'Плановой работы'],
            ['title'=>'Не плановой работы'],
        ]);
    }
}
