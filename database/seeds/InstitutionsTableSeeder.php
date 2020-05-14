<?php

use Illuminate\Database\Seeder;
use App\Institution;
class InstitutionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        Institution::create([
            'name' => 'University of Champions',
            'address' => '55 Ave',
            'email' => 'iadmin1@test.com',
            'type' => 'tertiary',
            'system_id' => 1
        ]);
    }
}
