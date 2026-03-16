<?php

namespace Database\Factories;

use App\Models\Federation;
use App\Models\FederationMember;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FederationMember>
 */
class FederationMemberFactory extends Factory
{
    protected $model = FederationMember::class;

    public function definition(): array
    {
        return [
            'provider_id' => Provider::factory(),
            'federation_id' => Federation::factory(),
            'joinstate' => 0,
            'isdisabled' => false,
            'isbanned' => false,
        ];
    }
}
