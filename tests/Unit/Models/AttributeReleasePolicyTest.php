<?php

use App\Models\AttributeReleasePolicy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new AttributeReleasePolicy())->getTable())->toBe('attribute_release_policy');
});

it('has correct fillable attributes with provider_id', function (): void {
    $fillable = (new AttributeReleasePolicy())->getFillable();
    expect($fillable)->toContain('type')
        ->toContain('attribute_id')
        ->toContain('provider_id')
        ->toContain('requester_id');
    expect($fillable)->not->toContain('idp_id');
});

it('belongs to an attribute', function (): void {
    expect((new AttributeReleasePolicy())->attribute())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a provider via provider_id', function (): void {
    $rel = (new AttributeReleasePolicy())->provider();
    expect($rel)->toBeInstanceOf(BelongsTo::class)
        ->and($rel->getForeignKeyName())->toBe('provider_id');
});

it('has a requester relation to a service provider', function (): void {
    $rel = (new AttributeReleasePolicy())->requester();
    expect($rel)->toBeInstanceOf(BelongsTo::class)
        ->and($rel->getForeignKeyName())->toBe('requester_id');
});

it('can be created via factory', function (): void {
    $policy = AttributeReleasePolicy::factory()->make();
    expect($policy)->toBeInstanceOf(AttributeReleasePolicy::class)
        ->and($policy->type)->not->toBeNull();
});
