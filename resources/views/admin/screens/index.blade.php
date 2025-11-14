@extends('layouts.admin')

@section('title', 'Manage Screens')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Screens</h1>
        <a href="{{ route('admin.screens.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add Screen</a>
    </div>

    @if($screens->isEmpty())
        <p>No screens found.</p>
    @else
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Seats</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($screens as $screen)
                        <tr>
                            <td class="px-6 py-4">{{ $screen->name }}</td>
                            <td class="px-6 py-4">{{ $screen->total_seats }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.screens.edit', $screen) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.screens.destroy', $screen) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete screen?')" class="text-red-600 hover:underline ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection