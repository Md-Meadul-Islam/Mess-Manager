<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealsTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'month',
        'batch',
        'create_at',
        'created_at',
        'update_at',
        'updated_at',

        // Other fillable properties...
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
