<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Let's clear the users table first
        //User::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and 
        // let's hash it before the loop, or else our seeder 
        // will be too slow.
        $password = Hash::make('password');

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => $password,
            'role' => 'superadmin'
        ]);
        User::create([
            'name' => 'Uther Pendragon',
            'email' => 'iadmin1@test.com',
            'password' => $password,
            'role' => 'admin',
            'institution_id' => 1
        ]);
        User::create([
            'name' => 'Jonathan Discipline',
            'email' => 'ilecturer1@test.com',
            'password' => $password,
            'role' => 'lecturer',
            'institution_id' => 1
        ]);
        User::create([
            'name' => 'Luis Akwetey',
            'email' => 'istudent1@test.com',
            'password' => $password,
            'role' => 'student',
            'institution_id' => 1
        ]);
        
    }
}
