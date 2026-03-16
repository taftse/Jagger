<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Provider>
 */
class ProviderFactory extends Factory
{
    protected $model = Provider::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['IDP', 'SP', 'BOTH']);

        return [
            'name' => fake()->company(),
            'lname' => null,
            'displayname' => fake()->company(),
            'ldisplayname' => null,
            'entityid' => 'https://' . fake()->unique()->domainName() . '/saml/metadata',
            'nameidformat' => null,
            'nameids' => null,
            'protocol' => null,
            'protocolsupport' => null,
            'type' => $type,
            'wantassertsigned' => null,
            'wantauthnreqsigned' => null,
            'authnreqsigned' => null,
            'scope' => null,
            'digest' => null,
            'helpdeskurl' => null,
            'lhelpdeskurl' => null,
            'privacyurl' => null,
            'lprivacyurl' => null,
            'registrar' => null,
            'registerdate' => null,
            'regpolicy' => null,
            'validfrom' => null,
            'validto' => null,
            'description' => fake()->optional()->sentence(),
            'country' => null,
            'wayflist' => null,
            'excarps' => null,
            'is_approved' => true,
            'is_active' => true,
            'is_locked' => false,
            'is_static' => false,
            'is_local' => true,
            'hidepublic' => false,
            'owner_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function idp(): static
    {
        return $this->state(['type' => 'IDP']);
    }

    public function sp(): static
    {
        return $this->state(['type' => 'SP']);
    }
}
