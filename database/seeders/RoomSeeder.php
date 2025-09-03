<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data for rooms
        \DB::table('rooms')->insert([
            [
                'name_room' => 'Conference Room A',
                'type' => 'conference',
                'capacity' => 20,
                'description' => 'A spacious conference room with a projector.',
                'status' => 'available',
            ],
            [
                'name_room' => 'Meeting Room B',
                'type' => 'meeting',
                'capacity' => 10,
                'description' => 'A small meeting room suitable for team discussions.',
                'status' => 'available',
            ],
            [
                'name_room' => 'Training Room C',
                'type' => 'training',
                'capacity' => 30,
                'description' => 'A training room equipped with whiteboards and seating.',
                'status' => 'booked',
            ],
        ]);
        
    }
}
