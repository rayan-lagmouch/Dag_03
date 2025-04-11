<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserting default person types
        DB::table('person_types')->insert([
            'name' => 'Customer', // Change 'Customer' to whatever you want
            'is_active' => true
        ]);

        DB::table('person_types')->insert([
            'name' => 'Employee', // Change 'Employee' to whatever you want
            'is_active' => true
        ]);
    }
}
