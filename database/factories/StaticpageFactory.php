<?php

namespace Database\Factories;

use App\Models\Staticpage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Staticpage>
 */
class StaticpageFactory extends Factory
{
    protected $model = Staticpage::class;

    public function definition(): array
    {
        return [
            'pcode' => fake()->unique()->lexify('page_???'),
            'pcategory' => fake()->optional()->word(),
            'ptitle' => fake()->sentence(3),
            'ptext' => fake()->optional()->paragraphs(2, true),
            'ispublic' => true,
            'enabled' => true,
        ];
    }
}
