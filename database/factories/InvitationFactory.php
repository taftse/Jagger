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
            'token' => fake()->md5(),
            'validationkey' => fake()->md5(),
            'mailfrom' => fake()->safeEmail(),
            'mailto' => fake()->safeEmail(),
            'created_at' => now()->toDateTimeString(),
            'validto' => now()->addDays(7)->timestamp,
            'is_valid' => true,
            'targettype' => fake()->randomElement(['federation', 'provider']),
            'targetid' => fake()->numerify('###'),
            'actiontype' => 'join',
            'actionvalue' => fake()->numerify('###'),
        ];
    }
}
