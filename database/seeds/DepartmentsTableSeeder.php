<?php

use Illuminate\Database\Seeder;
use App\Department;
class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Computer Science',
            'school_id' => 1
        ]);
    }
}
