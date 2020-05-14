<?php

use Illuminate\Database\Seeder;
use App\Year;
class YearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Year::create([
            'name' => 'Level 100',
            'for' => 'tertiary',
            'system_id' => 1
        ]);
 
    }
}
