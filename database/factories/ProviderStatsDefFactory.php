<?php

namespace Database\Factories;

use App\Models\Provider;
use App\Models\ProviderStatsDef;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProviderStatsDef>
 */
class ProviderStatsDefFactory extends Factory
{
    protected $model = ProviderStatsDef::class;

    public function definition(): array
    {
        return [
            'shortname' => fake()->unique()->lexify('stat_???'),
            'titlename' => fake()->words(3, true),
            'provider_id' => Provider::factory(),
            'type' => fake()->randomElement(['login', 'attribute', 'error']),
            'predefinedcol' => null,
            'method' => null,
            'formattype' => null,
            'sourceurl' => null,
            'accesstype' => null,
            'authuser' => null,
            'authpass' => null,
            'displayoptions' => null,
            'postoptions' => null,
            'description' => fake()->sentence(),
            'overwrite' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
