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
            'given_name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'type' => \App\Enums\ContactType::Technical,
            'is_sirtfi' => false,
            'phone' => fake()->optional()->phoneNumber(),
            'provider_id' => Provider::factory(),
        ];
    }
}
