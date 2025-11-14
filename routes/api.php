<?php

use App\Http\Controllers\SeatApiController;
use Illuminate\Support\Facades\Route;

Route::get('/seats', [SeatApiController::class, 'index']);