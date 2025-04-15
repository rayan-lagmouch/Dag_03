<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Specify the table name (optional)
    protected $table = 'contacts';  // Ensure the table is 'contacts'

    // Define the fillable attributes that match the column names in the database
    protected $fillable = [
        'person_id',  // Matches person_id in your database (foreign key to persons table)
        'mobile',     // Matches mobile in your database
        'email',      // Matches email in your database
    ];

    // Define the relationship with the Person model
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');  // Correct foreign key
    }
}
