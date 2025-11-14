@extends('layouts.admin')

@section('title', 'Edit Seat')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Seat</h1>

    <form action="{{ route('admin.seats.update', $seat) }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Screen</label>
            <select name="screen_id" class="w-full border rounded px-3 py-2">
                @foreach($screens as $screen)
                    <option value="{{ $screen->id }}" {{ $screen->id == $seat->screen_id ? 'selected' : '' }}>
                        {{ $screen->name }} ({{ $screen->total_seats }} seats)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Seat Number</label>
            <input type="text" name="seat_number" class="w-full border rounded px-3 py-2" 
                   value="{{ old('seat_number', $seat->seat_number) }}" placeholder="e.g., A1">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="available" {{ $seat->status === 'available' ? 'selected' : '' }}>Available</option>
                <option value="booked" {{ $seat->status === 'booked' ? 'selected' : '' }}>Booked</option>
                <option value="broken" {{ $seat->status === 'broken' ? 'selected' : '' }}>Broken</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Update</button>
            <a href="{{ route('admin.seats.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
@endsection