<?php

use App\Models\AttributeReleasePolicy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new AttributeReleasePolicy())->getTable())->toBe('attribute_release_policy');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new AttributeReleasePolicy())->getFillable();
    expect($fillable)->toContain('type')
        ->toContain('attribute_id')
        ->toContain('idp_id')
        ->toContain('requester');
});

it('casts requester as integer', function (): void {
    $casts = (new AttributeReleasePolicy())->getCasts();
    expect($casts['requester'])->toBe('integer');
});

it('has no timestamps', function (): void {
    expect((new AttributeReleasePolicy())->usesTimestamps())->toBeFalse();
});

it('belongs to an Attribute', function (): void {
    expect((new AttributeReleasePolicy())->attribute())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to an IDP Provider', function (): void {
    expect((new AttributeReleasePolicy())->idp())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $policy = AttributeReleasePolicy::factory()->make();
    expect($policy)->toBeInstanceOf(AttributeReleasePolicy::class)
        ->and($policy->type)->not->toBeNull();
});
