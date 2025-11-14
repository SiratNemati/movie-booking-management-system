@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
        
        <!-- Poster -->
        <div class="md:col-span-1">
            @if($movie->poster)
                <img src="{{ asset('storage/posters/' . $movie->poster) }}" 
                     alt="{{ $movie->title }}" 
                     class="w-full h-full object-cover min-h-96 md:min-h-full">
            @else
                <div class="bg-gradient-to-br from-gray-200 to-gray-300 w-full h-96 flex items-center justify-center border-2 border-dashed border-gray-400">
                    <span class="text-gray-600 text-xl font-medium">No Poster</span>
                </div>
            @endif
        </div>

        <!-- Movie Details -->
        <div class="md:col-span-2 p-8 md:p-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">{{ $movie->title }}</h1>
            
            <p class="text-lg text-gray-600 mb-6">
                <span class="font-medium">{{ $movie->genre }}</span> 
                • {{ \Carbon\Carbon::parse($movie->release_date)->format('F j, Y') }}
            </p>

            <p class="text-gray-700 leading-relaxed mb-8 text-justify">
                {{ $movie->description }}
            </p>

            <!-- Book Button -->
            @auth
                <a href="{{ route('bookings.create', $movie) }}" 
                   class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold text-lg px-8 py-4 rounded-lg shadow-md hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200">
                    Book Ticket Now
                </a>
            @else
                <p class="text-gray-600">
                    Please 
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold underline hover:text-indigo-800">
                        login
                    </a> 
                    to book a ticket.
                </p>
            @endauth
        </div>
    </div>
</div>
@endsection