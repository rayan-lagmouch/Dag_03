<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lane extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'has_fence', 'is_active'];

    // If you want to define the table explicitly (optional)
    // protected $table = 'lanes';
}
