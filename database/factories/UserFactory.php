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
            'username' => fake()->unique()->userName(),
            'password' => sha1('password' . 'testsalt'),
            'salt' => 'testsalt',
            'email' => fake()->unique()->safeEmail(),
            'givenname' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'userpref' => null,
            'local' => true,
            'federated' => false,
            'approved' => true,
            'enabled' => true,
            'validated' => true,
            'lastlogin' => null,
            'lastip' => null,
        ];
    }

    public function disabled(): static
    {
        return $this->state(['enabled' => false]);
    }

    public function federated(): static
    {
        return $this->state(['federated' => true, 'local' => false]);
    }
}
