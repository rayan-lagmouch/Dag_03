<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Specify the table name (optional)
    protected $table = 'contacts';  // The table is called 'contact' (not 'contacts')

    // Define the fillable attributes that match the column names in the database
    protected $fillable = [
        'personId',  // Matches PersonId in your database
        'Mobile',    // Matches Mobile in your database
        'Email',     // Matches Email in your database
    ];

    // Define the relationship with the Person model
    public function person()
    {
        return $this->belongsTo(Person::class, 'PersonId');  // Ensure the correct foreign key
    }
}
