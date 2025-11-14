@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700">Total Movies</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $movieCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700">Screens</h3>
            <p class="text-3xl font-bold text-green-600">{{ $screenCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700">Seats</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $seatCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700">Bookings</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $bookingCount }}</p>
        </div>
    </div>
@endsection