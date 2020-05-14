<?php

use Illuminate\Database\Seeder;
use App\SubjectUser;
class SubjectUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       SubjectUser::create([
            'subject_id' => 1,
            'user_id' => 4
        ]);
    }
}
