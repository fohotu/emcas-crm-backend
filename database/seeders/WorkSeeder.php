<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Work;
class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        //
       Work::factory()
            ->count(10)
            ->create();
        
    }
}
