@extends('layouts.admin')

@section('title', 'Manage Bookings')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">All Bookings</h1>
    </div>

    @if($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Movie</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Screen</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Seat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Show Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4">{{ $booking->movie->title }}</td>
                            <td class="px-6 py-4">{{ $booking->screen->name }}</td>
                            <td class="px-6 py-4">{{ $booking->seat->seat_number }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->show_time)->format('g:i A') }}</td>
                            <td class="px-6 py-4">${{ number_format($booking->price, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                       ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.bookings.edit', $booking) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this booking?')" class="text-red-600 hover:underline ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection