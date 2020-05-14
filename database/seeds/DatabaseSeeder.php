<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(SystemsTableSeeder::class);
    	$this->call(InstitutionsTableSeeder::class);
    	$this->call(SchoolsTableSeeder::class);
    	$this->call(YearsTableSeeder::class);
    	$this->call(TermsTableSeeder::class);
    	$this->call(DepartmentsTableSeeder::class);
    	$this->call(SubjectsTableSeeder::class);
    	$this->call(UsersTableSeeder::class);
    	$this->call(TopicsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(SubjectUserTableSeeder::class);
    }
}
