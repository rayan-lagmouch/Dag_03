<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'nickname',
        'is_adult',
        'person_type_id',
    ];

    // Relationships
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

// In Person.php model
public function contact()
{
    return $this->hasOne(Contact::class);
}


    // Full name accessor
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}

