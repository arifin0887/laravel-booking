<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

/*
|--------------------------------------------------------------------------
| ROLE HELPERS
|--------------------------------------------------------------------------
*/
public function isAdmin(): bool
{
    return $this->role === 'admin';
}

public function isUser(): bool
{
    return $this->role === 'user';
}

/*
|--------------------------------------------------------------------------
| RELATIONS
|--------------------------------------------------------------------------
*/

// /**
//  * Get the parent that owns the {{ class }}
//  * 
//  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//  */
//  public function bookings(): BelongsTo 
//  {
//     return $this->belongsTo(Booking::class, 'user_id', 'id');
//  }       

/**
 * Get all of the children for the {{ class }}
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function bookings(): HasMany
{
    return $this->hasMany(Booking::class, 'user_id', 'id');
}

}