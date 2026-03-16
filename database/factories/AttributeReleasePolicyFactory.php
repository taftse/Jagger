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
            'type' => fake()->randomElement(['default', 'customsp', 'specific']),
            'attribute_id' => Attribute::factory(),
            'idp_id' => Provider::factory(),
            'requester' => fake()->optional()->randomNumber(3),
        ];
    }
}
