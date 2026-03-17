<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'old_password' => sha1('password' . 'testsalt'),
            'old_salt' => 'testsalt',
            'given_name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'user_pref' => null,
            'is_local' => true,
            'is_federated' => false,
            'is_approved' => true,
            'is_enabled' => true,
            'is_validated' => true,
            'last_login' => null,
            'last_ip' => null,
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(['email_verified_at' => null]);
    }

    public function disabled(): static
    {
        return $this->state(['is_enabled' => false]);
    }

    public function federated(): static
    {
        return $this->state(['is_federated' => true, 'is_local' => false]);
    }
}
