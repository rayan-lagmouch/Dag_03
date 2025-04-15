<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonType;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert default person types into person_types table if they don't already exist
        if (PersonType::where('name', 'customer')->doesntExist()) {
            PersonType::create([
                'name' => 'customer',
                'is_active' => true,
            ]);
        }

        if (PersonType::where('name', 'employee')->doesntExist()) {
            PersonType::create([
                'name' => 'employee',
                'is_active' => true,
            ]);
        }

        if (PersonType::where('name', 'guest')->doesntExist()) {
            PersonType::create([
                'name' => 'guest',
                'is_active' => true,
            ]);
        }
    }
}