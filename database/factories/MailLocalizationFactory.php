<?php

namespace Database\Factories;

use App\Models\MailLocalization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MailLocalization>
 */
class MailLocalizationFactory extends Factory
{
    protected $model = MailLocalization::class;

    public function definition(): array
    {
        return [
            'mgroup' => fake()->word(),
            'lang' => fake()->languageCode(),
            'msgbody' => fake()->paragraphs(2, true),
            'msgsubject' => fake()->sentence(3),
            'isdefault' => false,
            'isenabled' => true,
            'alwaysattach' => false,
        ];
    }
}
