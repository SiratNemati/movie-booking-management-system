<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-6 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : '' }}">Dashboard</a>
                <a href="{{ route('admin.movies.index') }}" class="block py-2 px-6 hover:bg-gray-700 {{ request()->routeIs('admin.movies.*') ? 'bg-gray-900' : '' }}">Movies</a>
                <a href="{{ route('admin.screens.index') }}" class="block py-2 px-6 hover:bg-gray-700 {{ request()->routeIs('admin.screens.*') ? 'bg-gray-900' : '' }}">Screens</a>
                <a href="{{ route('admin.seats.index') }}" class="block py-2 px-6 hover:bg-gray-700 {{ request()->routeIs('admin.seats.*') ? 'bg-gray-900' : '' }}">Seats</a>
                <a href="{{ route('admin.bookings.index') }}" class="block py-2 px-6 hover:bg-gray-700 {{ request()->routeIs('admin.bookings.*') ? 'bg-gray-900' : '' }}">Bookings</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-6 px-6">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-300">Logout</button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-8">
                @include('components.alert')
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>