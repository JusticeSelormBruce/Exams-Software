<?php

use Illuminate\Database\Seeder;
use App\School;
class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         School::create([
            'name' => 'School of Basic and Applied Science',
            'institution_id' => 1,
            'system_id' => 1
        ]);
    }
}
