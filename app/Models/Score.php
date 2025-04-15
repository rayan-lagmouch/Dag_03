<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'person_id',
        'points',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function game()
{
    return $this->belongsTo(Game::class);
}

}
