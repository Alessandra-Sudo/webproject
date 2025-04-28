<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'customer_id',
        'items',
        'total',
        'status',
        'date_ordered',
    ];
}
