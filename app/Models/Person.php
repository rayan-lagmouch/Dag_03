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
        'type_id', // This will link to TypePerson (customer/employee)
    ];

    public function type()
    {
        return $this->belongsTo(TypePerson::class, 'type_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }
    
    public function games()
{
    return $this->hasMany(Game::class);
}
}
