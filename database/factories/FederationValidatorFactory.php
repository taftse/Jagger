<?php

namespace Database\Factories;

use App\Models\Federation;
use App\Models\FederationValidator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FederationValidator>
 */
class FederationValidatorFactory extends Factory
{
    protected $model = FederationValidator::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'federation_id' => Federation::factory(),
            'is_enabled' => true,
            'is_mandatory' => false,
            'is_reg_enabled' => false,
            'url' => fake()->url(),
            'method' => fake()->randomElement(['GET', 'POST']),
            'entity_param' => 'entityID',
            'opt_args' => null,
            'arg_separator' => null,
            'document_type' => 'application/xml',
            'description' => fake()->sentence(),
            'return_code_element' => 'returncode',
            'return_code_value' => '0',
            'message_code_element' => 'message',
        ];
    }
}
