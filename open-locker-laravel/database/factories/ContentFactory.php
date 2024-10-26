<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $devices = [
            "Smartphone",
            "Tablet",
            "Smartwatch",
            "E-reader",
            "Gaming Console",
            "Portable Speaker",
            "Fitness Tracker",
            "Digital Camera",
            "GPS Device",
            "MP3 Player"
        ];

        $isInUse = fake()->boolean(20);
        $randomUser = User::query()
            ->where('is_admin', '=', false)
            ->first();

        return [
            'name' => $devices[array_rand($devices)],
            'user_id' => true === $isInUse ? $randomUser->getId() : null,
        ];
    }
}
