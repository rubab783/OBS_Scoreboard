<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@scoreboard.com'],
            [
                'name'     => 'Admin',
                'email'    => 'admin@scoreboard.com',
                'password' => Hash::make('password123'),
            ]
        );

        $this->command->info('✅ Admin created → admin@scoreboard.com / password123');
    }
}