<?php

namespace App\Http\Controllers;

use App\Models\Screen;
use Illuminate\Http\Request;

class ScreenController extends Controller
{
    public function index()
    {
        $screens = Screen::with('seats')->get();
        return view('admin.screens.index', compact('screens'));
    }

    public function create()
    {
        return view('admin.screens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
        ]);

        Screen::create($request->all());

        return redirect()->route('admin.screens.index')->with('success', 'Screen created successfully.');
    }

    public function edit(Screen $screen)
    {
        return view('admin.screens.edit', compact('screen'));
    }

    public function update(Request $request, Screen $screen)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_seats' => 'required|integer|min:1',
        ]);

        $screen->update($request->all());

        return redirect()->route('admin.screens.index')->with('success', 'Screen updated successfully.');
    }

    public function destroy(Screen $screen)
    {
        $screen->delete();
        return redirect()->route('admin.screens.index')->with('success', 'Screen deleted successfully.');
    }
}