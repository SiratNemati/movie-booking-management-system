@extends('layouts.app')

@section('title', 'Book Ticket - ' . $movie->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-319xl font-bold mb-8 text-center">Book Ticket: {{ $movie->title }}</h1>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $movie->id }}">

        <!-- Screen Selection -->
        <div class="mb-6">
            <label class="block text-lg font-medium mb-3">Select Screen</label>
            <select name="screen_id" id="screen_id" class="w-full border rounded-lg px-4 py-3 text-lg" required>
                <option value="">-- Choose Screen --</option>
                @foreach($screens as $screen)
                    <option value="{{ $screen->id }}" data-price="{{ $screen->price }}" data-times='{{ $screen->show_times }}'>
                        {{ $screen->name }} ({{ $screen->total_seats }} seats • ${{ $screen->price }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Show Time -->
        <div class="mb-6">
            <label class="block text-lg font-medium mb-3">Select Show Time</label>
            <select name="show_time" id="show_time" class="w-full border rounded-lg px-4 py-3 text-lg" required disabled>
                <option value="">-- First select a screen --</option>
            </select>
        </div>

        <!-- Price (Auto-filled) -->
        <div class="mb-6">
            <label class="block text-lg font-medium mb-3">Price</label>
            <input type="text" id="price_display" class="w-full border rounded-lg px-4 py-3 bg-gray-100 text-lg font-bold" readonly value="Select screen first">
            <input type="hidden" name="price" id="price_input">
        </div>

        <!-- Seat Map -->
        <div class="mb-8">
            <p class="text-lg font-medium mb-4 text-center">Select Your Seat</p>
            <div id="seat-map" class="grid grid-cols-10 gap-2 max-w-2xl mx-auto"></div>
            <div class="text-center mt-4 space-x-6">
                <span class="inline-block w-8 h-8 bg-green-500 rounded"></span> Available
                <span class="inline-block w-8 h-8 bg-red-500 rounded"></span> Booked
                <span class="inline-block w-8 h-8 bg-blue-600 rounded"></span> Selected
            </div>
        </div>

        <input type="hidden" name="seat_id" id="selected_seat">

        <div class="flex justify-center gap-6">
            <button type="submit" id="book_btn" disabled class="bg-indigo-600 text-white px-10 py-4 rounded-lg text-lg font-bold hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed">
                Confirm Booking
            </button>
            <a href="{{ route('movies.show', $movie) }}" class="bg-gray-500 text-white px-10 py-4 rounded-lg text-lg font-bold hover:bg-gray-600">
                Back
            </a>
        </div>
    </form>
</div>

@push('scripts')
@push('scripts')
@push('scripts')
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const screenSelect = document.getElementById('screen_id');
        const timeSelect = document.getElementById('show_time');
        const priceDisplay = document.getElementById('price_display');
        const priceInput = document.getElementById('price_input');
        const seatMap = document.getElementById('seat-map');
        const bookBtn = document.getElementById('book_btn');
        const selectedSeatInput = document.getElementById('selected_seat');

        let selectedSeat = null;

        // SCREEN CHANGE
        screenSelect.addEventListener('change', function () {
            const option = this.options[this.selectedIndex];
            const times = option ? JSON.parse(option.dataset.times || '[]') : [];
            const price = option ? parseFloat(option.dataset.price) : 0;

            // Reset
            timeSelect.innerHTML = '<option value="">-- Select Time --</option>';
            timeSelect.disabled = true;
            seatMap.innerHTML = '<p class="col-span-10 text-center py-8">Select screen and time</p>';
            bookBtn.disabled = true;
            selectedSeatInput.value = '';
            selectedSeat = null;
            priceDisplay.value = 'Select screen first';
            priceInput.value = '';

            if (!option) return;

            priceDisplay.value = `$${price.toFixed(2)}`;
            priceInput.value = price;

            times.forEach(time => {
                const opt = document.createElement('option');
                opt.value = time;
                opt.textContent = time;
                timeSelect.appendChild(opt);
            });
            timeSelect.disabled = false;
        });

        // TIME CHANGE
        timeSelect.addEventListener('change', function () {
            if (this.value && screenSelect.value) {
                loadSeats(screenSelect.value, this.value);
            }
        });

        // LOAD SEATS
        function loadSeats(screenId, showTime) {
            seatMap.innerHTML = '<p class="col-span-10 text-center py-8">Loading seats...</p>';

            fetch(`/api/seats?screen_id=${screenId}&show_time=${encodeURIComponent(showTime)}`)
                .then(res => {
                    if (!res.ok) throw new Error('Network error');
                    return res.json();
                })
                .then(seats => {
                    seatMap.innerHTML = '';
                    bookBtn.disabled = true;
                    selectedSeat = null;

                    seats.forEach(seat => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.textContent = seat.seat_number;
                        btn.dataset.seatId = seat.id;
                        btn.className = 'w-12 h-12 rounded font-bold text-white transition';

                        if (seat.status === 'available') {
                            btn.className += ' bg-green-500 hover:bg-green-600';
                            btn.onclick = function () {
                                // Remove blue from ALL
                                seatMap.querySelectorAll('button').forEach(b => {
                                    b.classList.remove('bg-blue-600');
                                    b.classList.remove('hover:bg-blue-700');
                                });
                                // Add blue to THIS
                                this.className = this.className.replace('bg-green-500', 'bg-blue-600');
                                this.className = this.className.replace('hover:bg-green-600', 'hover:bg-blue-700');
                                selectedSeat = seat.id;
                                selectedSeatInput.value = seat.id;
                                bookBtn.disabled = false;
                            };
                        } else {
                            btn.className += ' bg-red-500 cursor-not-allowed';
                            btn.disabled = true;
                        }
                        seatMap.appendChild(btn);
                    });
                })
                .catch(err => {
                    seatMap.innerHTML = '<p class="col-span-10 text-center text-red-500">Error loading seats</p>';
                    console.error(err);
                });
        }
    });
</script>
@endpush
@endpush
@endpush
@endpush
@endsection