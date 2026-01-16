<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 1; $i <= 10; $i++) {
                Lead::create([
                    'full_name' => $user->name . " Lead $i",
                    'phone' => '9989' . rand(1000000, 9999999),
                    'status' => ['new', 'in_progress', 'done'][array_rand(['new', 'in_progress', 'done'])],
                    'note' => 'This is a note for lead ' . $i,
                    'assigned_to' => $user->id,
                ]);
            }
        }
    }
}
