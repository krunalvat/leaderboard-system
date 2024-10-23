<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\User;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                Activity::create([
                    'user_id' => $user->id,
                    'activity_date' => now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}
