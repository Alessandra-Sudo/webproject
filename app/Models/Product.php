<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'price',
        'category',
        'details',
        'stocks',
        'image_url',
    ];
}
