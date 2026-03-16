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
            'statdefinition_id' => ProviderStatsDef::factory(),
            'format' => fake()->randomElement(['json', 'csv', 'xml']),
            'statfilename' => fake()->unique()->slug() . '.json',
            'created_at' => now(),
        ];
    }
}
