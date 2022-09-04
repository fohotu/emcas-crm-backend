<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  App\Models\Answer;

class TaskAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Answer::factory()
        ->count(300)
        ->create();
    }
}
