<?php

namespace Database\Factories;

use App\Models\Jcrontab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jcrontab>
 */
class JcrontabFactory extends Factory
{
    protected $model = Jcrontab::class;

    public function definition(): array
    {
        return [
            'jminute' => '0',
            'jhour' => '0',
            'jdayofmonth' => '*',
            'jmonth' => '*',
            'jdayofweek' => '*',
            'jcommand' => fake()->word(),
            'jparams' => '',
            'jservers' => null,
            'tonotify' => false,
            'jcomment' => fake()->sentence(),
            'isenabled' => true,
            'istemplate' => false,
            'lastrun' => null,
        ];
    }
}
