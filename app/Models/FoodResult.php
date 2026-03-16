<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodResult extends Model
{
    use HasFactory;
    protected $table = 'food_result'; // Specify table name

    // This ensures created_at is always a Carbon object
    protected $casts = [
        'created_at' => 'datetime',
        'food_items' => 'array',
    ];
}
