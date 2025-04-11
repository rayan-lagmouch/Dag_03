<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonType extends Model
{
    use HasFactory;

    // Table name if it's different from the plural of the model name
    protected $table = 'person_types'; // Ensure this matches the table name in your database

    protected $fillable = ['name']; // Assuming 'name' is the column describing the type, like 'Customer', 'Employee'

    // Define a relationship to the Person model
    public function persons()
    {
        return $this->hasMany(Person::class, 'type_id');
    }
}
