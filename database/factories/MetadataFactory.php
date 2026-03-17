<?php

namespace Database\Factories;

use App\Models\Metadata;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Metadata>
 */
class MetadataFactory extends Factory
{
    protected $model = Metadata::class;

    public function definition(): array
    {
        return [
            'metadata' => base64_encode('<EntityDescriptor entityID="https://example.com/saml"/>'),
            'provider_id' => Provider::factory(),
        ];
    }
}
