<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partner>
 */
class PartnerFactory extends Factory
{
    protected $model = Partner::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->company(),
            'contact' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'homeurl' => fake()->unique()->url(),
            'description' => fake()->sentence(),
        ];
    }
}
