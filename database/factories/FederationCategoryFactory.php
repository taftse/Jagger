<?php

namespace Database\Factories;

use App\Models\FederationCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FederationCategory>
 */
class FederationCategoryFactory extends Factory
{
    protected $model = FederationCategory::class;

    public function definition(): array
    {
        return [
            'shortname' => fake()->unique()->lexify('????'),
            'descname' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'isdefault' => false,
        ];
    }
}
