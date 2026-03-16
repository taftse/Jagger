<?php

namespace Database\Factories;

use App\Models\Certificate;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Certificate>
 */
class CertificateFactory extends Factory
{
    protected $model = Certificate::class;

    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['idpsso', 'spsso']),
            'certusage' => fake()->optional()->randomElement(['signing', 'encryption']),
            'certtype' => 'X509Certificate',
            'certdata' => fake()->sha256(),
            'encmethods' => null,
            'subject' => fake()->optional()->word(),
            'provider_id' => Provider::factory(),
            'is_default' => true,
            'keyname' => fake()->optional()->word(),
        ];
    }
}
