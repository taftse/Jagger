<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attribute>
 */
class AttributeFactory extends Factory
{
    protected $model = Attribute::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->slug(2),
            'full_name' => fake()->sentence(3),
            'oid' => '1.3.6.1.4.1.' . fake()->numerify('####.#.#'),
            'urn' => 'urn:oid:' . fake()->numerify('#.#.#.####'),
            'in_metadata' => true,
            'description' => fake()->optional()->sentence(),
        ];
    }
}
