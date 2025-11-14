<?php

namespace App\Http\Controllers;

use App\Models\Screen;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        $seats = Seat::with('screen')->get();
        return view('admin.seats.index', compact('seats'));
    }

    public function create()
    {
        $screens = Screen::all();
        return view('admin.seats.create', compact('screens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'screen_id' => 'required|exists:screens,id',
            'seat_number' => 'required|string|max:10',
            'status' => 'required|in:available,booked,broken',
        ]);

        Seat::create($request->all());

        return redirect()->route('admin.seats.index')->with('success', 'Seat created successfully.');
    }

    public function edit(Seat $seat)
    {
        $screens = Screen::all();
        return view('admin.seats.edit', compact('seat', 'screens'));
    }

    public function update(Request $request, Seat $seat)
    {
        $request->validate([
            'screen_id' => 'required|exists:screens,id',
            'seat_number' => 'required|string|max:10',
            'status' => 'required|in:available,booked,broken',
        ]);

        $seat->update($request->all());

        return redirect()->route('admin.seats.index')->with('success', 'Seat updated successfully.');
    }

    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->route('admin.seats.index')->with('success', 'Seat deleted successfully.');
    }
}