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
            'type' => \App\Enums\CertificateType::IdpSso,
            'cert_usage' => \App\Enums\CertificateUsage::Signing,
            'cert_type' => 'X509Certificate',
            'cert_data' => fake()->sha256(),
            'enc_methods' => null,
            'subject' => fake()->optional()->word(),
            'provider_id' => Provider::factory(),
            'is_default' => true,
            'key_name' => fake()->optional()->word(),
        ];
    }
}
