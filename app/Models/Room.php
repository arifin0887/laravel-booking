<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array <int, string>
     */
    protected $fillable = ['name_room', 'price', 'capacity', 'description', 'status'];

    /**
     * The attributes that should be hidden for serialization.
     * @var array <int, string>
     */
    protected $hidden = [];


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
    // public function parent(): BelongsTo
    // {
    //     return $this->belongsTo(Parent::class, 'foreign_key', 'owner_key');
    // }

    /**
     * Get all of the children for the {{ class }}
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }
}