<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\Screen;
use App\Models\Seat;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $movieCount = Movie::count();
        $screenCount = Screen::count();
        $seatCount = Seat::count();
        $bookingCount = Booking::count();

        return view('admin.dashboard', compact(
            'movieCount',
            'screenCount',
            'seatCount',
            'bookingCount'
        ));
    }
}