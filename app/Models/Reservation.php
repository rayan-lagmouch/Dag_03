<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReservationStatus; // ✅ Add this line

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'opening_time_id',
        'lane_id',
        'package_option_id',
        'reservation_status_id',
        'date',
        'start_time',
        'end_time',
        'adult_count',
        'child_count',
        'is_active',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function packageOption()
    {
        return $this->belongsTo(PackageOption::class);
    }

    public function reservationStatus()
    {
        return $this->belongsTo(ReservationStatus::class);
    }

    public function scopeConfirmed($query)
    {
        return $query->whereHas('reservationStatus', function ($q) {
            $q->where('name', 'confirmed');
        });
    }
}
