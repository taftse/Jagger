<?php

use App\Models\Metadata;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new Metadata())->getTable())->toBe('provider_metadata');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Metadata())->getFillable();
    expect($fillable)->toContain('metadata')
        ->toContain('provider_id');
});

it('has no timestamps', function (): void {
    expect((new Metadata())->usesTimestamps())->toBeFalse();
});

it('belongs to a provider', function (): void {
    expect((new Metadata())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $metadata = Metadata::factory()->make();
    expect($metadata)->toBeInstanceOf(Metadata::class)
        ->and($metadata->metadata)->not->toBeNull();
});
