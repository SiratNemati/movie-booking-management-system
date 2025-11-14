@extends('layouts.admin')

@section('title', 'Edit Booking')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Booking</h1>

    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Movie</label>
            <select name="movie_id" class="w-full border rounded px-3 py-2" required>
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}" {{ $movie->id == $booking->movie_id ? 'selected' : '' }}>
                        {{ $movie->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Screen</label>
            <select name="screen_id" class="w-full border rounded px-3 py-2" required>
                @foreach($screens as $screen)
                    <option value="{{ $screen->id }}" {{ $screen->id == $booking->screen_id ? 'selected' : '' }}>
                        {{ $screen->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Seat</label>
            <select name="seat_id" class="w-full border rounded px-3 py-2" required>
                @foreach($seats as $seat)
                    <option value="{{ $seat->id }}" {{ $seat->id == $booking->seat_id ? 'selected' : '' }}>
                        {{ $seat->seat_number }} ({{ $seat->status }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Show Time</label>
            <input type="datetime-local" name="show_time" class="w-full border rounded px-3 py-2" 
                   value="{{ old('show_time', $booking->show_time->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Price</label>
            <input type="number" name="price" step="0.01" min="0" class="w-full border rounded px-3 py-2" 
                   value="{{ old('price', $booking->price) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2" required>
                <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Update</button>
            <a href="{{ route('admin.bookings.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
@endsection