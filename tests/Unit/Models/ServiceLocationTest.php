<?php

use App\Models\ServiceLocation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new ServiceLocation())->getTable())->toBe('service_location');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new ServiceLocation())->getFillable();
    expect($fillable)->toContain('type')
        ->toContain('binding_name')
        ->toContain('url')
        ->toContain('provider_id');
});

it('casts is_default as boolean', function (): void {
    $casts = (new ServiceLocation())->getCasts();
    expect($casts['is_default'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new ServiceLocation())->usesTimestamps())->toBeFalse();
});

it('belongs to a provider', function (): void {
    expect((new ServiceLocation())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $location = ServiceLocation::factory()->make();
    expect($location)->toBeInstanceOf(ServiceLocation::class)
        ->and($location->url)->not->toBeNull()
        ->and($location->binding_name)->not->toBeNull();
});
