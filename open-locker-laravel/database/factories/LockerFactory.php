<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\locker>
 */
class LockerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isOpen = fake()->boolean(20);

        return [
            'designation' => fake()->randomNumber(3),
            'is_open' => $isOpen,
            'last_opened_at' => true === $isOpen ? now()->subMinute() : fake()->dateTimeThisMonth('now'),
        ];
    }
}
