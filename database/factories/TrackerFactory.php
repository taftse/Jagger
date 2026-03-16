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
            'resourcetype' => fake()->optional()->randomElement(['idp', 'sp', 'fed', 'user']),
            'subtype' => fake()->optional()->word(),
            'resourcename' => fake()->optional()->domainName(),
            'sourceip' => fake()->optional()->ipv4(),
            'useragent' => fake()->optional()->userAgent(),
            'user' => fake()->optional()->userName(),
            'created_at' => now(),
            'detail' => fake()->optional()->sentence(),
        ];
    }
}
