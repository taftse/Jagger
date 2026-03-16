<?php

namespace Database\Factories;

use App\Models\Partner;
use App\Models\Partnership;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partnership>
 */
class PartnershipFactory extends Factory
{
    protected $model = Partnership::class;

    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['full', 'associate']),
            'provider_id' => Provider::factory(),
            'partner_id' => Partner::factory(),
        ];
    }
}
