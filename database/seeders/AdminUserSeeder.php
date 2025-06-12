<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@blog.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role_id' => 1,
                'hearts' => 1000, // Optional: Set initial hearts for the admin
            ]
        );
        User::updateOrCreate(
            ['email' => 'user1@blog.com'],
            [
                'name' => 'User One',
                'password' => bcrypt('12345678'),
                'role_id' => 2,
            ]
        );
        User::updateOrCreate(
            ['email' => 'user2@blog.com'],
            [
                'name' => 'User Two',
                'password' => bcrypt('12345678'),
                'role_id' => 2,
            ]
        );
    }
}
