@extends('layouts.admin')

@section('title', 'Add Seat')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add New Seat</h1>

    <form action="{{ route('admin.seats.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Screen</label>
            <select name="screen_id" class="w-full border rounded px-3 py-2">
                @foreach($screens as $screen)
                    <option value="{{ $screen->id }}">{{ $screen->name }} ({{ $screen->total_seats }} seats)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Seat Number</label>
            <input type="text" name="seat_number" class="w-full border rounded px-3 py-2" value="{{ old('seat_number') }}" placeholder="e.g., A1">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="available">Available</option>
                <option value="booked">Booked</option>
                <option value="broken">Broken</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Save</button>
            <a href="{{ route('admin.seats.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
@endsection