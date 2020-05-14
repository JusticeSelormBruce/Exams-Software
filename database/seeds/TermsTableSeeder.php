<?php

use Illuminate\Database\Seeder;
use App\Term;
class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Term::create([
           'name' => 'Semester I',
            'system_id' => 1,
            'for' => 'tertiary'
        ]);
           Term::create([
           'name' => 'Semester II',
            'system_id' => 1,
            'for' => 'tertiary'
        ]);
    }
}
