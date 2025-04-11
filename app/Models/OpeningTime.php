<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeningTime extends Model
{
    use HasFactory;

    protected $fillable = ['day_name', 'start_time', 'end_time', 'is_active'];

    // If you want to define the table explicitly (optional)
    // protected $table = 'opening_times';
}
