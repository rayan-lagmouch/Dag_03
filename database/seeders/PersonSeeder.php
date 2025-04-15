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
        // Insert records based on the provided data
        Person::create([
            'first_name' => 'Mazin',
            'middle_name' => null,
            'last_name' => 'Jamil',
            'nickname' => 'Mazin',
            'is_adult' => true,
            'person_type_id' => 1,  // Assuming 1 refers to 'customer'
        ]);

        Person::create([
            'first_name' => 'Arjan',
            'middle_name' => 'de',
            'last_name' => 'Ruijter',
            'nickname' => 'Arjan',
            'is_adult' => true,
            'person_type_id' => 1,  // Assuming 1 refers to 'customer'
        ]);

        Person::create([
            'first_name' => 'Hans',
            'middle_name' => null,
            'last_name' => 'Odijk',
            'nickname' => 'Hans',
            'is_adult' => true,
            'person_type_id' => 1,  // Assuming 1 refers to 'customer'
        ]);

        Person::create([
            'first_name' => 'Dennis',
            'middle_name' => 'van',
            'last_name' => 'Wakeren',
            'nickname' => 'Dennis',
            'is_adult' => true,
            'person_type_id' => 1,  // Assuming 1 refers to 'customer'
        ]);

        Person::create([
            'first_name' => 'Wilco',
            'middle_name' => 'Van',
            'last_name' => 'de Grift',
            'nickname' => 'Wilco',
            'is_adult' => true,
            'person_type_id' => 2,  // Assuming 2 refers to 'employee'
        ]);

        Person::create([
            'first_name' => 'Tom',
            'middle_name' => null,
            'last_name' => 'Sanders',
            'nickname' => 'Tom',
            'is_adult' => false,
            'person_type_id' => 3,  // Assuming 3 refers to 'guest'
        ]);

        Person::create([
            'first_name' => 'Andrew',
            'middle_name' => null,
            'last_name' => 'Sanders',
            'nickname' => 'Andrew',
            'is_adult' => false,
            'person_type_id' => 3,  // Assuming 3 refers to 'guest'
        ]);

        Person::create([
            'first_name' => 'Julian',
            'middle_name' => null,
            'last_name' => 'Kaldenheuvel',
            'nickname' => 'Julian',
            'is_adult' => false,
            'person_type_id' => 3,  // Assuming 3 refers to 'guest'
        ]);
    }
}
