<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads = Lead::all();

        for ($i = 1; $i <= 15; $i++) {
            $lead = $leads->random();

            Task::create([
                'lead_id' => $lead->id,
                'title' => 'Task ' . $i . ' for ' . $lead->full_name,
                'due_at' => rand(0,1) ? Carbon::now()->addDays(rand(1, 10)) : null,
                'is_done' => rand(0,1),
            ]);
        }
    }
}
