<?php

namespace Database\Factories;

use App\Models\Acl;
use App\Models\AclResource;
use App\Models\AclRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Acl>
 */
class AclFactory extends Factory
{
    protected $model = Acl::class;

    public function definition(): array
    {
        return [
            'resource_id' => AclResource::factory(),
            'role_id' => AclRole::factory(),
            'action' => fake()->randomElement(['read', 'write', 'delete', 'admin']),
            'access' => fake()->boolean(),
        ];
    }
}
