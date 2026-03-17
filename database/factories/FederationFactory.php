<?php

namespace Database\Factories;

use App\Models\Federation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Federation>
 */
class FederationFactory extends Factory
{
    protected $model = Federation::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => $name,
            'sysname' => fake()->unique()->slug(2),
            'urn' => 'urn:mace:' . fake()->unique()->domainWord() . ':' . fake()->slug(),
            'descriptorid' => fake()->optional()->slug(),
            'publisher' => fake()->optional()->url(),
            'publisherexport' => fake()->optional()->url(),
            'description' => fake()->optional()->sentence(),
            'is_active' => true,
            'is_protected' => false,
            'is_public' => true,
            'is_lexport' => false,
            'is_local' => true,
            'digest' => fake()->optional()->randomElement(['sha1', 'sha256']),
            'digestexport' => fake()->optional()->randomElement(['sha1', 'sha256']),
            'attrreq_inmeta' => true,
            'tou' => fake()->optional()->paragraph(),
            'usealtmetaurl' => false,
            'altmetaurl' => null,
            'owner' => fake()->optional()->email(),
        ];
    }
}
