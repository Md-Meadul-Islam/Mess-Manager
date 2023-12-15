<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'ip',
        'geo_location',
        'user_agent',
        'created_at',

    ];
}
