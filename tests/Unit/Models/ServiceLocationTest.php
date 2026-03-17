<?php

use App\Enums\ServiceLocationType;
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
        ->toContain('is_default')
        ->toContain('ordered_no')
        ->toContain('provider_id');
});

it('casts type as ServiceLocationType enum', function (): void {
    $casts = (new ServiceLocation())->getCasts();
    expect($casts['type'])->toBe(ServiceLocationType::class);
});

it('uses Laravel timestamps', function (): void {
    expect((new ServiceLocation())->usesTimestamps())->toBeTrue();
});

it('belongs to a Provider', function (): void {
    expect((new ServiceLocation())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $sl = ServiceLocation::factory()->make();
    expect($sl)->toBeInstanceOf(ServiceLocation::class)
        ->and($sl->type)->toBe(ServiceLocationType::AssertionConsumerService);
});
