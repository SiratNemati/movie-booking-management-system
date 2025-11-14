<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatApiController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'screen_id' => 'required|exists:screens,id',
            'show_time' => 'required|string', // e.g. "21:30"
        ]);

        $screenId = $request->screen_id;
        $showTime = $request->show_time; // "21:30"

        // Get all seats
        $seats = Seat::where('screen_id', $screenId)
            ->select('id', 'seat_number')
            ->get()
            ->map(function ($seat) {
                $seat->status = $seat->status ?? 'available'; // Default
                return $seat;
            });

        // Match only TIME part (21:30:00)
        $bookedSeatIds = Booking::where('screen_id', $screenId)
            ->whereRaw("TIME(show_time) = ?", [$showTime . ':00'])
            ->pluck('seat_id')
            ->toArray();

        // Mark as booked
        $seats = $seats->map(function ($seat) use ($bookedSeatIds) {
            if (in_array($seat->id, $bookedSeatIds)) {
                $seat->status = 'booked';
            }
            return $seat;
        });

        return response()->json($seats);
    }
}