<?php

use App\Models\StaticMetadata;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new StaticMetadata())->getTable())->toBe('provider_metadata');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new StaticMetadata())->getFillable();
    expect($fillable)->toContain('metadata')
        ->toContain('provider_id');
});

it('has no timestamps', function (): void {
    expect((new StaticMetadata())->usesTimestamps())->toBeFalse();
});

it('belongs to a provider', function (): void {
    expect((new StaticMetadata())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $metadata = StaticMetadata::factory()->make();
    expect($metadata)->toBeInstanceOf(StaticMetadata::class)
        ->and($metadata->metadata)->not->toBeNull();
});
