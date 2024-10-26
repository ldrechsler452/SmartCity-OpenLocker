<?php

namespace Database\Seeders;

use App\Models\Content;
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
        // Create non-admin user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123',
        ]);

        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '123',
            'is_admin' => true,
        ]);

        for ($i = 0; $i < 3; $i++) {
            $station = Station::factory()->create();
            $lockers = Locker::factory(3)->create([
                'station_id' => $station->getId(),
            ]);

            /** @var Locker[] $lockers */
            foreach ($lockers as $locker) {
                $content = Content::factory()->create();
                $locker
                    ->setContent($content)
                    ->save();
            }
        }
    }
}
