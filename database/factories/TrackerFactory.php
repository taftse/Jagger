<?php

namespace Database\Factories;

use App\Models\Tracker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tracker>
 */
class TrackerFactory extends Factory
{
    protected $model = Tracker::class;

    public function definition(): array
    {
        return [
            'resource_type' => fake()->optional()->randomElement(['idp', 'sp', 'fed', 'user']),
            'subtype' => fake()->optional()->word(),
            'resource_name' => fake()->optional()->domainName(),
            'source_ip' => fake()->optional()->ipv4(),
            'user_agent' => fake()->optional()->userAgent(),
            'user' => fake()->optional()->userName(),
            'created_at' => now(),
            'detail' => fake()->optional()->sentence(),
        ];
    }
}
