<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'total_seats',
        'show_times',  
        'price',       
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'show_times' => 'array',  // Auto-convert JSON ↔ PHP array
        'price' => 'decimal:2',
    ];

    // Relationships
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}