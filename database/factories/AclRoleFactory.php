<?php

namespace Database\Factories;

use App\Models\AclRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AclRole>
 */
class AclRoleFactory extends Factory
{
    protected $model = AclRole::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'type' => fake()->randomElement(['system', 'custom']),
            'description' => fake()->sentence(3),
            'parent_id' => null,
        ];
    }
}
