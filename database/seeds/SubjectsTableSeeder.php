<?php

use Illuminate\Database\Seeder;
use App\Subject;
class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'Introduction to Programing',
            'code' => 'CS101',
            'for' => 'tertiary',
            'subjectable_id' => 1,
            'subjectable_type' => 'App\Institution'
        ]);
    }
}
