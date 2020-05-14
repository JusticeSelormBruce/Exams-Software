<?php

use Illuminate\Database\Seeder;
use App\System;
class SystemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        System::create([
            'name' => 'Collegial',
            'type' => 'specific',
            'for' => 'tertiary',
            'description' => 'Collegial System'
        ]);
    }
}
