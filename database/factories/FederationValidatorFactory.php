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
            'is_regenabled' => false,
            'url' => fake()->url(),
            'method' => fake()->randomElement(['GET', 'POST']),
            'entityparam' => 'entityID',
            'optargs' => null,
            'argseparator' => null,
            'documenttype' => 'application/xml',
            'description' => fake()->sentence(),
            'returncodeelement' => 'returncode',
            'returncodevalue' => '0',
            'messagecodeelement' => 'message',
        ];
    }
}
