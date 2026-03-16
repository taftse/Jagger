<?php

namespace Database\Factories;

use App\Models\JaggerQueue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JaggerQueue>
 */
class JaggerQueueFactory extends Factory
{
    protected $model = JaggerQueue::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'action' => fake()->word(),
            'recipient' => fake()->optional()->numerify('###'),
            'recipienttype' => fake()->optional()->randomElement(['user', 'provider', 'federation']),
            'type' => fake()->randomElement(['provider_join', 'provider_leave', 'user_approve']),
            'objdata' => json_encode(['id' => fake()->randomNumber()]),
            'objtype' => fake()->randomElement(['provider', 'federation', 'user']),
            'creator' => User::factory(),
            'email' => fake()->safeEmail(),
            'fullname' => fake()->optional()->name(),
            'srcip' => fake()->ipv4(),
            'token' => fake()->md5(),
            'is_confirmed' => false,
            'created_at' => now()->toDateTimeString(),
        ];
    }
}
