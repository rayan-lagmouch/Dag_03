<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\PersonType;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run()
    {
        // Assuming PersonType exists (e.g., Customer, Employee)
        $customerType = PersonType::where('name', 'customer')->first();
        $employeeType = PersonType::where('name', 'employee')->first();

        // Create employee
        Person::create([
            'person_type_id' => $employeeType->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'nickname' => 'JD',
            'is_adult' => true,
        ]);

        // Create customer
        Person::create([
            'person_type_id' => $customerType->id,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'nickname' => 'JS',
            'is_adult' => true,
        ]);
    }
}
