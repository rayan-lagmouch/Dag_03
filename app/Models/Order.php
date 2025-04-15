<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'person_id',
        'total_amount',
        'status', // e.g., pending, completed
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
