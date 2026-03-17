<?php

use App\Enums\AttributeRequirementStatus;
use App\Enums\AttributeRequirementType;
use App\Models\Attribute;
use App\Models\AttributeRequirement;
use App\Models\Federation;
use App\Models\Provider;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can create an attribute with snake_case fields', function (): void {
    $attr = Attribute::factory()->create();

    $this->assertDatabaseHas('attribute', [
        'id' => $attr->id,
        'full_name' => $attr->full_name,
        'in_metadata' => true,
    ]);
});

it('can create attribute requirement linked to provider', function (): void {
    $attr = Attribute::factory()->create();
    $provider = Provider::factory()->create();

    $req = AttributeRequirement::factory()->create([
        'attribute_id' => $attr->id,
        'provider_id' => $provider->id,
        'federation_id' => null,
        'type' => AttributeRequirementType::SP,
        'status' => AttributeRequirementStatus::Required,
    ]);

    expect($req->provider->id)->toBe($provider->id)
        ->and($req->type)->toBe(AttributeRequirementType::SP)
        ->and($req->status)->toBe(AttributeRequirementStatus::Required);
});

it('can create attribute requirement linked to federation', function (): void {
    $attr = Attribute::factory()->create();
    $fed = Federation::factory()->create();

    $req = AttributeRequirement::factory()->create([
        'attribute_id' => $attr->id,
        'provider_id' => null,
        'federation_id' => $fed->id,
        'type' => AttributeRequirementType::Federation,
    ]);

    expect($req->federation->id)->toBe($fed->id);
});
