@extends('layouts.admin')

@section('title', 'Add Screen')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add New Screen</h1>

    <form action="{{ route('admin.screens.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Screen Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Total Seats</label>
            <input type="number" name="total_seats" min="1" class="w-full border rounded px-3 py-2" value="{{ old('total_seats') }}">
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Save</button>
            <a href="{{ route('admin.screens.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
        </div>
    </form>
@endsection