<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'address',
        'image',
        'room_count',
        'room_types',
    ];

    protected $casts = [
        'room_types' => 'array',
    ];
}
