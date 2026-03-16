<?php

namespace Database\Factories;

use App\Models\AclResource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AclResource>
 */
class AclResourceFactory extends Factory
{
    protected $model = AclResource::class;

    public function definition(): array
    {
        return [
            'resource' => fake()->unique()->word(),
            'description' => fake()->optional()->sentence(),
            'type' => fake()->optional()->randomElement(['controller', 'model', 'route']),
            'parent_id' => null,
            'default_value' => fake()->optional()->randomElement(['allow', 'deny']),
        ];
    }
}
