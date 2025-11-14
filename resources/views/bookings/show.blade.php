@extends('layouts.app')

@section('title', 'Booking Confirmed')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow text-center max-w-2xl mx-auto">
        <div class="mb-6">
            <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="text-3xl font-bold mb-4">Booking Confirmed!</h1>
        <p class="text-gray-600 mb-6">Your ticket has been booked successfully.</p>

        <div class="bg-gray-50 p-6 rounded-lg text-left mb-6">
            <h3 class="font-semibold text-lg mb-3">Booking Details</h3>
            <p><strong>Movie:</strong> {{ $booking->movie->title }}</p>
            <p><strong>Screen:</strong> {{ $booking->screen->name }}</p>
            <p><strong>Seat:</strong> {{ $booking->seat->seat_number }}</p>
            <p><strong>Show Time:</strong> {{ \Carbon\Carbon::parse($booking->show_time)->format('g:i A') }}</p>
            <p><strong>Price:</strong> ${{ number_format($booking->price, 2) }}</p>
            <p><strong>Status:</strong> 
                <span class="px-2 py-1 text-xs rounded-full {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </p>
        </div>

        <a href="{{ route('movies.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700 inline-block">
            Back to Movies
        </a>
    </div>
@endsection