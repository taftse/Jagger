<?php

use App\Models\Attribute;
use App\Models\AttributeReleasePolicy;
use App\Models\AttributeRequirement;
use App\Models\Federation;
use App\Models\Provider;

it('can create and retrieve an attribute', function (): void {
    $attribute = Attribute::factory()->create();
    expect(Attribute::find($attribute->id))->not->toBeNull()
        ->and(Attribute::find($attribute->id)->name)->toBe($attribute->name);
});

it('can create an attribute release policy', function (): void {
    $attribute = Attribute::factory()->create();
    $provider = Provider::factory()->idp()->create();

    $policy = AttributeReleasePolicy::factory()->create([
        'attribute_id' => $attribute->id,
        'idp_id' => $provider->id,
    ]);

    expect($policy->attribute->id)->toBe($attribute->id)
        ->and($policy->idp->id)->toBe($provider->id);
});

it('can create an attribute requirement for SP', function (): void {
    $attribute = Attribute::factory()->create();
    $provider = Provider::factory()->sp()->create();

    $req = AttributeRequirement::factory()->create([
        'attribute_id' => $attribute->id,
        'sp_id' => $provider->id,
        'type' => 'SP',
    ]);

    expect($req->type)->toBe('SP')
        ->and($req->attribute->id)->toBe($attribute->id);
});

it('can create an attribute requirement for Federation', function (): void {
    $attribute = Attribute::factory()->create();
    $federation = Federation::factory()->create();

    $req = AttributeRequirement::factory()->create([
        'attribute_id' => $attribute->id,
        'fed_id' => $federation->id,
        'type' => 'FED',
    ]);

    expect($req->type)->toBe('FED')
        ->and($req->federation->id)->toBe($federation->id);
});
