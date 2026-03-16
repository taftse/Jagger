<?php

namespace Database\Factories;

use App\Models\NotificationList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NotificationList>
 */
class NotificationListFactory extends Factory
{
    protected $model = NotificationList::class;

    public function definition(): array
    {
        return [
            'subscriber' => User::factory(),
            'notificationtype' => fake()->randomElement(['email', 'sms']),
            'type' => fake()->randomElement(['provider', 'federation', 'user']),
            'provider' => null,
            'federation' => null,
            'email' => fake()->optional()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'isenabled' => true,
            'isapproved' => false,
            'created' => now(),
            'updated' => now(),
        ];
    }
}
