<?php

namespace Database\Factories;

use App\Models\Preferences;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Preferences>
 */
class PreferencesFactory extends Factory
{
    protected $model = Preferences::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->lexify('pref_????'),
            'stype' => fake()->randomElement(['text', 'bool', 'multicheck', 'singlecheck', 'settings']),
            'scategory' => fake()->randomElement(['general', 'mail', 'ui']),
            'descname' => fake()->words(3, true),
            'pvalue' => fake()->optional()->word(),
            'serializedvalue' => null,
            'is_enabled' => true,
            'description' => fake()->sentence(),
        ];
    }
}
