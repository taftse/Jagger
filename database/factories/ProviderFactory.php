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
        $type = fake()->randomElement([\App\Enums\ProviderType::IdentityProvider, \App\Enums\ProviderType::ServiceProvider, \App\Enums\ProviderType::Both]);

        return [
            'name' => fake()->company(),
            'localized_name' => null,
            'display_name' => fake()->company(),
            'localized_display_name' => null,
            'entity_id' => 'https://' . fake()->unique()->domainName() . '/saml/metadata',
            'nameid_format' => null,
            'name_ids' => null,
            'protocol' => null,
            'protocol_support' => null,
            'type' => $type,
            'want_assert_signed' => null,
            'want_authn_req_signed' => null,
            'authn_req_signed' => null,
            'scope' => null,
            'digest' => null,
            'helpdesk_url' => null,
            'localized_helpdesk_url' => null,
            'privacy_url' => null,
            'localized_privacy_url' => null,
            'registrar' => null,
            'register_date' => null,
            'reg_policy' => null,
            'valid_from' => null,
            'valid_to' => null,
            'description' => fake()->optional()->sentence(),
            'country' => null,
            'wayf_list' => null,
            'exc_arps' => null,
            'is_approved' => true,
            'is_active' => true,
            'is_locked' => false,
            'is_static' => false,
            'is_local' => true,
            'hide_from_public' => false,
            'owner_id' => null,
        ];
    }

    public function idp(): static
    {
        return $this->state(['type' => \App\Enums\ProviderType::IdentityProvider]);
    }

    public function sp(): static
    {
        return $this->state(['type' => \App\Enums\ProviderType::ServiceProvider]);
    }
}
