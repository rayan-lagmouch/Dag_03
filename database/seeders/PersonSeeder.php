<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
=======
use Illuminate\Database\Seeder;
use App\Models\Person;
>>>>>>> 29d7d07c4ba733f6f74d20e371becc578a2db6ce

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
<<<<<<< HEAD
     */
    public function run(): void
    {
        //
=======
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
>>>>>>> 29d7d07c4ba733f6f74d20e371becc578a2db6ce
    }
}
