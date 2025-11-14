<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\Screen;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'movie', 'screen', 'seat'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create(Movie $movie)
    {
        $screens = Screen::all();
        return view('bookings.create', compact('movie', 'screens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'screen_id' => 'required|exists:screens,id',
            'seat_id' => 'required|exists:seats,id',
            'show_time' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $seat = Seat::findOrFail($request->seat_id);

        if ($seat->status !== 'available') {
            return back()->withErrors(['seat_id' => 'This seat is no longer available.']);
        }

        $showDateTime = now()->format('Y-m-d') . ' ' . $request->show_time . ':00';

        DB::transaction(function () use ($request, $seat, $showDateTime) {
            Booking::create([
                'user_id' => Auth::id(),
                'movie_id' => $request->movie_id,
                'screen_id' => $request->screen_id,
                'seat_id' => $request->seat_id,
                'show_time' => $showDateTime,
                'price' => $request->price,
                'status' => 'confirmed',
            ]);

            $seat->update(['status' => 'booked']);
        });

        return redirect()->route('bookings.show', Booking::latest()->first())
            ->with('success', 'Booking confirmed!');
    }
    public function show(Booking $booking)
    {
        $booking->load(['movie', 'screen', 'seat', 'user']);
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $movies = Movie::all();
        $screens = Screen::all();
        $seats = Seat::all();
        return view('admin.bookings.edit', compact('booking', 'movies', 'screens', 'seats'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'screen_id' => 'required|exists:screens,id',
            'seat_id' => 'required|exists:seats,id',
            'show_time' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $oldSeat = $booking->seat;

        DB::transaction(function () use ($request, $booking, $oldSeat) {
            $booking->update($request->all());

            if ($oldSeat->id !== $request->seat_id) {
                $oldSeat->update(['status' => 'available']);
                Seat::find($request->seat_id)->update(['status' => 'booked']);
            }
        });

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated.');
    }

    public function destroy(Booking $booking)
    {
        $booking->seat->update(['status' => 'available']);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted.');
    }
}