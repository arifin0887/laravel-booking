<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
| RELATIONS
|--------------------------------------------------------------------------
*/

/**
 * Get the parent that owns the {{ class }}
 * 
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
 public function bookings(): BelongsTo 
 {
    return $this->belongsTo(Booking::class, 'user_id', 'id');
 }       

// /**
//  * Get all of the children for the {{ class }}
//  * @return \Illuminate\Database\Eloquent\Relations\HasMany
//  */
// public function children(): HasMany
// {
//     return $this->hasMany(Child::class, 'foreign_key', 'local_key');
// }

}