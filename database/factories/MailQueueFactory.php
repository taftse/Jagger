<?php

namespace Database\Factories;

use App\Models\MailQueue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MailQueue>
 */
class MailQueueFactory extends Factory
{
    protected $model = MailQueue::class;

    public function definition(): array
    {
        return [
            'deliverytype' => fake()->randomElement(['smtp', 'log']),
            'rcptto' => fake()->safeEmail(),
            'msubject' => fake()->sentence(3),
            'mbody' => fake()->paragraphs(2, true),
            'frequence' => fake()->randomElement(['1', 'H', 'D', 'W']),
            'createdat' => now(),
            'sentat' => null,
            'issent' => false,
        ];
    }
}
