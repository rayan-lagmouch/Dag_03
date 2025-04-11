<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example data for Person seeder
        Person::create([
            'first_name' => 'John',
            'middle_name' => 'Doe',  // You can set this as null if not required
            'last_name' => 'Doe',
            'nickname' => 'Johnny',
            'is_adult' => true,  // Adjust as necessary, defaults to true
            'person_type_id' => 1,  // Ensure this refers to a valid 'person_types' ID
        ]);

        // You can add more records as needed
    }
}
