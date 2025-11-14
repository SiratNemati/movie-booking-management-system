<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
        'name' => 'sirat',
        'email' => 'sirat@gmail.com',
        'password' => bcrypt('123123123'),
        'role' => 'admin',
    ]);
    }
}
