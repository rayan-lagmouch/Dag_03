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
        'last_name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'person_type_id',
    ];

    // Relationship to the PersonType model
    public function type()
    {
        return $this->belongsTo(PersonType::class, 'person_type_id');
    }

    // Relationship to the Reservation model (One-to-Many)
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Relationship to the Contact model (One-to-One)
    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    // Accessor for full name (optional)
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
