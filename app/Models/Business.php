<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_url',
        'rating',
        'review_count',
        'categories',
        'price',
        'location',
        'latitude',
        'longitude',
        'phone',
    ];
}
