<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\AttributeReleasePolicy;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AttributeReleasePolicy>
 */
class AttributeReleasePolicyFactory extends Factory
{
    protected $model = AttributeReleasePolicy::class;

    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['SP', 'FED']),
            'attribute_id' => Attribute::factory(),
            'provider_id' => Provider::factory(),
            'requester_id' => null,
        ];
    }
}
