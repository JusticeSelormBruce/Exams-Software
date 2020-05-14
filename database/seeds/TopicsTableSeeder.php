<?php

use Illuminate\Database\Seeder;
use App\Topic;
class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Topic::create([
            'name' => 'Fundermental Programming Concepts',
            'subject_id' => 1,
            'term_id' => 1,
            'year_id' => 1,
            'user_id' => 2
        ]);
    }
}
