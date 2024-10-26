<?php

namespace Database\Seeders;

use App\Models\Locker;
use App\Models\Station;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123',
        ]);

        for ($i = 0; $i < 3; $i++) {
            $station = Station::factory()->create();
            Locker::factory(5)->create([
                'station_id' => $station->getId(),
            ]);
        }
    }
}
