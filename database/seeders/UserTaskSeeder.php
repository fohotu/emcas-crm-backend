<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserTask;
class UserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserTask::factory()
        ->count(200)
        ->create();
    }

}
