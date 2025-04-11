<?php

// database/seeders/PersonTypesSeeder.php

use Illuminate\Database\Seeder;
use DB;

class PersonTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('person_types')->insert([
            ['name' => 'customer'],
            ['name' => 'employee'],
        ]);
    }
}
