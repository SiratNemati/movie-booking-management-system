<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\SeatController;
use Illuminate\Support\Facades\Route;

// === PUBLIC ROUTES (Guests & Users) ===
Route::get('/', function () {
    return redirect()->route('movies.index');
});

// Movies: Everyone can view list and details
Route::resource('movies', MovieController::class)->only(['index', 'show']);

// === AUTHENTICATED CUSTOMER ROUTES ===
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings/create/{movie}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});

// === ADMIN ROUTES (auth + admin middleware) ===
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Movies: Admin CRUD (no public index/show)
    Route::resource('movies', MovieController::class)->except(['show']);

    // Screens: Full CRUD except show
    Route::resource('screens', ScreenController::class)->except(['show']);

    // Seats: Full CRUD except show
    Route::resource('seats', SeatController::class)->except(['show']);

    // Bookings: Admin can manage (no create/store/show for admin)
    Route::resource('bookings', BookingController::class)->except(['create', 'store', 'show']);
});

// === BREEZE AUTH ROUTES (Login, Register, etc.) ===
require __DIR__.'/auth.php';