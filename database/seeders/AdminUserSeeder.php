<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'findev@gmail.com'],
            [
                'name' => 'Findev',
                'password' => Hash::make('admindev'), // password default
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'herla@gmail.com'],
            [
                'name' => 'Herla',
                'password' => Hash::make('herladev'), // password default
                'role' => 'user',
            ]
        );
    }
}
