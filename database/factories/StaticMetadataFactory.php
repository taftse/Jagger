<?php

namespace Database\Factories;

use App\Models\Provider;
use App\Models\StaticMetadata;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StaticMetadata>
 */
class StaticMetadataFactory extends Factory
{
    protected $model = StaticMetadata::class;

    public function definition(): array
    {
        return [
            'metadata' => base64_encode('<EntityDescriptor entityID="https://example.com/saml"/>'),
            'provider_id' => Provider::factory(),
        ];
    }
}
