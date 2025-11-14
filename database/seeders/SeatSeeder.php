<?php

namespace Database\Seeders;

use App\Models\Screen;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        $screens = Screen::all();

        foreach ($screens as $screen) {
            $rows = match ($screen->id) {
                1 => 8, // 8x8
                2 => 6, // 6x8
                3 => 10, // 10x8
            };

            for ($row = 'A'; $row < chr(ord('A') + $rows); $row++) {
                for ($col = 1; $col <= 8; $col++) {
                    Seat::create([
                        'screen_id' => $screen->id,
                        'seat_number' => $row . $col,
                        'status' => 'available',
                    ]);
                }
            }
        }
    }
}