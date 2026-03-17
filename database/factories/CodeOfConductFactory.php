<?php

namespace Database\Factories;

use App\Models\CodeOfConduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CodeOfConduct>
 */
class CodeOfConductFactory extends Factory
{
    protected $model = CodeOfConduct::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2),
            'type' => 'entcat',
            'subtype' => fake()->optional()->url(),
            'url' => fake()->url(),
            'cdescription' => fake()->optional()->sentence(),
            'is_enabled' => fake()->boolean(),
            'lang' => fake()->optional()->languageCode(),
            'availfor' => fake()->optional()->randomElement(['idp', 'sp', 'both']),
        ];
    }
}
