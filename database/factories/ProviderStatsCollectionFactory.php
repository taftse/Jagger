<?php

namespace Database\Factories;

use App\Models\Provider;
use App\Models\ProviderStatsDef;
use App\Models\ProviderStatsCollection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProviderStatsCollection>
 */
class ProviderStatsCollectionFactory extends Factory
{
    protected $model = ProviderStatsCollection::class;

    public function definition(): array
    {
        return [
            'provider_id' => Provider::factory(),
            'stats_def_id' => ProviderStatsDef::factory(),
            'format' => fake()->randomElement(['json', 'csv', 'xml']),
            'stat_filename' => fake()->unique()->slug() . '.json',
        ];
    }
}
