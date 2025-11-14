@extends('layouts.admin')

@section('title', 'Edit Movie')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Movie</h1>

    <form action="{{ route('admin.movies.update', $movie) }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Title</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror" value="{{ old('title', $movie->title) }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $movie->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Genre</label>
            <input type="text" name="genre" class="w-full border rounded px-3 py-2" value="{{ old('genre', $movie->genre) }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Release Date</label>
            <input type="date" name="release_date" class="w-full border rounded px-3 py-2" value="{{ old('release_date', $movie->release_date?->format('Y-m-d')) }}">
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Update</button>
            <a href="{{ route('admin.movies.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
@endsection