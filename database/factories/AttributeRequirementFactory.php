<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\AttributeRequirement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AttributeRequirement>
 */
class AttributeRequirementFactory extends Factory
{
    protected $model = AttributeRequirement::class;

    public function definition(): array
    {
        return [
            'attribute_id' => Attribute::factory(),
            'sp_id' => null,
            'fed_id' => null,
            'type' => fake()->randomElement(['SP', 'FED']),
            'status' => fake()->optional()->randomElement(['required', 'optional']),
            'reason' => fake()->optional()->sentence(),
        ];
    }
}
