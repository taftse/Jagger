<?php

namespace Database\Factories;

use App\Models\Provider;
use App\Models\ServiceLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceLocation>
 */
class ServiceLocationFactory extends Factory
{
    protected $model = ServiceLocation::class;

    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['AssertionConsumerService', 'SingleLogoutService']),
            'binding_name' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
            'url' => fake()->url(),
            'is_default' => false,
            'ordered_no' => null,
            'provider_id' => Provider::factory(),
        ];
    }
}
