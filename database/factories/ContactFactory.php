<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'givenname' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'type' => fake()->randomElement(['technical', 'administrative', 'support', 'billing', 'other']),
            'issirfty' => false,
            'phone' => fake()->optional()->phoneNumber(),
            'provider_id' => Provider::factory(),
        ];
    }
}
