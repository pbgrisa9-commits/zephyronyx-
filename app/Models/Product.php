<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'age_category',
        'gender',
        'sport_category',
        'price',
        'stock',
        'description',
        'size',
        'color',
        'image',
    ];
}
