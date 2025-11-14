<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of movies.
     */
    public function index()
    {
        $movies = Movie::with('bookings')->get();

        // === ADMIN ROUTE: /admin/movies ===
        if (request()->route()->getName() === 'admin.movies.index') {
            return view('admin.movies.index', compact('movies'));
        }

        // === PUBLIC ROUTE: /movies ===
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new movie (Admin only).
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created movie in storage (Admin only).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:255',
            'release_date' => 'nullable|date',
            'poster' => 'nullable|string|max:255',
        ]);

        Movie::create($request->all());

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified movie (Public only).
     */
    public function show(Movie $movie)
    {
        $movie->load('bookings');
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified movie (Admin only).
     */
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Update the specified movie in storage (Admin only).
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:255',
            'release_date' => 'nullable|date',
            'poster' => 'nullable|string|max:255',
        ]);

        $movie->update($request->all());

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie updated successfully.');
    }

    /**
     * Remove the specified movie from storage (Admin only).
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie deleted successfully.');
    }
}