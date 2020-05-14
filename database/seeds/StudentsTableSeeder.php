<?php

use Illuminate\Database\Seeder;
use App\Student;
class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$password = Hash::make('Default');
         Student::create([
            'other_names' => 'Luis',
            'last_name' => 'Akwetey',
            'student_number' => '10187678',
            'institution_id' => 1,
            'department_id' => 1,
            'user_id' => 4,
            'password' => $password

            //'role_id' => 1
        ]);
    }
}
