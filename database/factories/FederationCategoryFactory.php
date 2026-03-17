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
            'short_name' => fake()->unique()->lexify('????'),
            'desc_name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'is_default' => false,
        ];
    }
}
