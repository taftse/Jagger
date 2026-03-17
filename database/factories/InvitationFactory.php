<?php

namespace Database\Factories;

use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invitation>
 */
class InvitationFactory extends Factory
{
    protected $model = Invitation::class;

    public function definition(): array
    {
        return [
            'token' => fake()->uuid(),
            'validation_key' => fake()->uuid(),
            'mail_from' => fake()->safeEmail(),
            'mail_to' => fake()->safeEmail(),
            'valid_till' => now()->addDays(7),
            'is_valid' => true,
            'target_type' => null,
            'target_id' => null,
            'actiontype' => 'join',
            'actionvalue' => fake()->numerify('###'),
        ];
    }
}
