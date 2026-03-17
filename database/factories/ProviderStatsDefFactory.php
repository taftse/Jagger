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
            'short_name' => fake()->unique()->lexify('stat_???'),
            'title_name' => fake()->words(3, true),
            'provider_id' => Provider::factory(),
            'type' => fake()->randomElement(['login', 'attribute', 'error']),
            'predefined_col' => null,
            'method' => null,
            'format_type' => null,
            'source_url' => null,
            'access_type' => null,
            'auth_user' => null,
            'auth_pass' => null,
            'display_options' => null,
            'post_options' => null,
            'description' => fake()->sentence(),
            'overwrite' => null,
        ];
    }
}
