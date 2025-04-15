<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Person;
use App\Models\Reservation;
use App\Models\Score;

class Game extends Model
{
    use HasFactory;

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function score()
    {
        return $this->hasOne(Score::class);
    }
}
