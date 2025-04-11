<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'person';  // Explicitly set the table to 'person'


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'person_type_id',  // This will link to PersonType (customer/employee)
    ];

    public function type()
    {
        return $this->belongsTo(PersonType::class, 'person_type_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }
}
