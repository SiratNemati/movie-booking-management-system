@extends('layouts.app')

@section('title', 'All Movies')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Now Showing</h1>

    @if($movies->isEmpty())
        <p class="text-gray-600">No movies available.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($movies as $movie)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition hover:scale-105">
                @if($movie->poster)
                    <img src="{{ asset('storage/posters/' . $movie->poster) }}" 
                        alt="{{ $movie->title }}" 
                        class="w-full h-64 object-cover">
                @else
                    <div class="bg-gray-200 border-2 border-dashed rounded-t-lg w-full h-64 flex items-center justify-center">
                        <span class="text-gray-500">No Poster</span>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $movie->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $movie->genre }} • {{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }}</p>
                    <p class="text-gray-700 mt-2 line-clamp-2">{{ $movie->description }}</p>
                    <a href="{{ route('movies.show', $movie) }}" 
                    class="mt-3 inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Book Ticket
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    @endif
@endsection