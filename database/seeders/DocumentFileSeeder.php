<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentFile;
class DocumentFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        //
       DocumentFile::factory()
            ->count(200)
            ->create();
        
    }
}
