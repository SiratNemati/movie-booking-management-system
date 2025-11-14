<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'screen_id',
        'seat_number',
        'status',
    ];

    // Relationships
    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}