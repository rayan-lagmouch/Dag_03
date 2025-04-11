<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'date',
        'lane_number',
        'package_option_id',
        'status', // For example: confirmed, pending, etc.
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function packageOption()
    {
        return $this->belongsTo(PackageOption::class);
    }

    public function games()
{
    return $this->hasMany(Game::class);
}
}
