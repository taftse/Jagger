<?php

namespace Database\Factories;

use App\Models\ExtendMetadata;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExtendMetadata>
 */
class ExtendMetadataFactory extends Factory
{
    protected $model = ExtendMetadata::class;

    public function definition(): array
    {
        return [
            'etype' => \App\Enums\ExtendMetadataType::Element,
            'provider_id' => Provider::factory(),
            'namespace' => fake()->word(),
            'parent_id' => null,
            'element' => fake()->word(),
            'evalue' => fake()->optional()->word(),
            'attributes' => fake()->optional()->word(),
        ];
    }
}
