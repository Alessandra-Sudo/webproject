<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class HelpRequest extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'user_id',
        'subject',
        'address',
        'message',
    ];
}
