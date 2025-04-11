<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonType extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'person_types';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name', 'is_active'
    ];

    // If you want to disable the timestamps, you can add this:
    // public $timestamps = false;
}
