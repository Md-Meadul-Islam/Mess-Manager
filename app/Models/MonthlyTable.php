<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'month',
        'dailymeals',
        'totalmeals',
        'dailybazar',
        'totalbazar',
        'batch',
        // Other fillable properties...
    ];
}
