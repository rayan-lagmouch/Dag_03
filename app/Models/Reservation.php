<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'date',
        'lane_number',
        'package_option_id',
        'status',
        'opening_time_id',
        'reservation_status_id',
    ];

    // Cast 'date' to Carbon instance
    protected $dates = ['date'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function packageOption()
    {
        return $this->belongsTo(PackageOption::class);
    }

    public function games()
{
    return $this->hasMany(Game::class);
}
    public function lane()
    {
        return $this->belongsTo(Lane::class);
    }
    public function reservationStatus()
    {
        return $this->belongsTo(ReservationStatus::class);
    }

    public function openingTime()
    {
        return $this->belongsTo(OpeningTime::class);
    }
}
