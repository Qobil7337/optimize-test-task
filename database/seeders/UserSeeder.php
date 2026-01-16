<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Alice Admin',
            'email' => 'alice@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Bob User',
            'email' => 'bob@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
