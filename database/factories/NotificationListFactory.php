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
            'user_id' => User::factory(),
            'notification_type' => fake()->randomElement(['email', 'sms']),
            'type' => fake()->randomElement(['provider', 'federation', 'user']),
            'provider_id' => null,
            'federation_id' => null,
            'email' => fake()->optional()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'is_enabled' => true,
            'is_approved' => false,
        ];
    }
}
