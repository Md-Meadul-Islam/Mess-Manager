<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function mealstable()
    {
        return $this->hasMany(MealsTable::class);
    }
    public function bazarstable()
    {
        return $this->hasMany(BazarsTable::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::created(
            function ($user) {
                $DateNow = now()->format('Ymd');
                $request = request();
                $findManager = User::where('role', 'manager')->where('batch', $request->phone2)->first();
                if (!Auth::user()) {
                    if ($request->role === 'manager') {
                        MealsTable::create([
                            'user_id' => $user->id,
                            'month' => now()->format("M-Y"),
                            'batch' => $request->phone,
                            'total' => 0,
                            'create_at' => $DateNow,
                            'created_at' => now(),
                        ]);
                    } elseif ($request->role === 'mate' && $findManager) {
                        MealsTable::create([
                            'user_id' => $user->id,
                            'month' => now()->format("M-Y"),
                            'batch' => $request->phone2,
                            'total' => 0,
                            'create_at' => $DateNow,
                            'created_at' => now(),
                        ]);
                    } else {
                        return redirect()->route('register');
                    }
                } else {
                    // Authenticated user
                    if (Auth::user()->role === 'manager') {
                        MealsTable::create([
                            'user_id' => $user->id,
                            'month' => now()->format("M-Y"),
                            'batch' => Auth::user()->batch,
                            'total' => 0,
                            'create_at' => $DateNow,
                            'created_at' => now(),
                        ]);
                    } else {
                        return redirect()->route('manager_mate.dashboard');
                    }
                }
                return redirect()->route('manager_mate.dashboard');
            }
        );
    }
}
