<?php

namespace Database\Seeders;

use App\Models\Screen;
use Illuminate\Database\Seeder;

class ScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $screens = [
            [
                'name' => 'Screen 1',
                'total_seats' => 64,
                'show_times' => ['10:00', '13:30', '17:00', '20:30', '23:00'],
                'price' => 12.50
            ],
            [
                'name' => 'Screen 2',
                'total_seats' => 48,
                'show_times' => ['11:00', '14:30', '18:00', '21:30'],
                'price' => 11.00
            ],
            [
                'name' => 'Screen 3',
                'total_seats' => 80,
                'show_times' => ['09:30', '12:00', '15:30', '19:00', '22:30'],
                'price' => 13.75
            ],
        ];

        foreach ($screens as $screen) {
            Screen::updateOrCreate(
                ['name' => $screen['name']], // Unique by name
                [
                    'total_seats' => $screen['total_seats'],
                    'show_times' => json_encode($screen['show_times']), // Store as JSON
                    'price' => $screen['price'],
                ]
            );
        }
    }
}