<?php

use App\Models\Provider;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

it('has correct table name', function (): void {
    expect((new Provider())->getTable())->toBe('provider');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Provider())->getFillable();
    expect($fillable)->toContain('entityid')
        ->toContain('type')
        ->toContain('is_active')
        ->toContain('is_local');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new Provider())->getCasts();
    expect($casts['is_active'])->toBe('boolean')
        ->and($casts['is_local'])->toBe('boolean')
        ->and($casts['is_approved'])->toBe('boolean')
        ->and($casts['is_locked'])->toBe('boolean');
});

it('has many membership records', function (): void {
    expect((new Provider())->membership())->toBeInstanceOf(HasMany::class);
});

it('has many contacts', function (): void {
    expect((new Provider())->contacts())->toBeInstanceOf(HasMany::class);
});

it('has many certificates', function (): void {
    expect((new Provider())->certificates())->toBeInstanceOf(HasMany::class);
});

it('has many service locations', function (): void {
    expect((new Provider())->serviceLocations())->toBeInstanceOf(HasMany::class);
});

it('has many attribute release policies', function (): void {
    expect((new Provider())->attributeReleasePolicies())->toBeInstanceOf(HasMany::class);
});

it('has many attribute requirements', function (): void {
    expect((new Provider())->attributeRequirements())->toBeInstanceOf(HasMany::class);
});

it('has one static metadata', function (): void {
    expect((new Provider())->metadata())->toBeInstanceOf(HasOne::class);
});

it('has many extend metadata records', function (): void {
    expect((new Provider())->extendMetadata())->toBeInstanceOf(HasMany::class);
});

it('has many stats definitions', function (): void {
    expect((new Provider())->statsDef())->toBeInstanceOf(HasMany::class);
});

it('belongs to many coc entries', function (): void {
    expect((new Provider())->coc())->toBeInstanceOf(BelongsToMany::class);
});

it('can be created via factory', function (): void {
    $provider = Provider::factory()->make();
    expect($provider)->toBeInstanceOf(Provider::class)
        ->and($provider->entityid)->toStartWith('https://')
        ->and($provider->is_active)->toBeTrue();
});

it('can create an IDP via factory state', function (): void {
    $provider = Provider::factory()->idp()->make();
    expect($provider->type)->toBe('IDP');
});

it('can create an SP via factory state', function (): void {
    $provider = Provider::factory()->sp()->make();
    expect($provider->type)->toBe('SP');
});
