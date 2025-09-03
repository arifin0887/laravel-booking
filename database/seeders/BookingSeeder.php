<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data for bookings
        \DB::table('bookings')->insert([
            [
                'room_id' => 1,
                'user_id' => 1,
                'start_time' => '2025-08-21 10:00:00',
                'end_time' => '2025-08-21 12:00:00',
                'status' => 'confirmed',
                'notes' => 'Project meeting with the team.',
            ],
            [
                'room_id' => 2,
                'user_id' => 2,
                'start_time' => '2025-08-22 14:00:00',
                'end_time' => '2025-08-22 15:30:00',
                'status' => 'pending',
                'notes' => 'Client presentation.',
            ],
        ]);
    }
}
