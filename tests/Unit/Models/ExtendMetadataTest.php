<?php

use App\Enums\ExtendMetadataType;
use App\Models\ExtendMetadata;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('has correct table name', function (): void {
    expect((new ExtendMetadata())->getTable())->toBe('extend_metadata');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new ExtendMetadata())->getFillable();
    expect($fillable)->toContain('etype')
        ->toContain('provider_id')
        ->toContain('namespace')
        ->toContain('element')
        ->toContain('attributes');
    expect($fillable)->not->toContain('attrs');
});

it('casts etype as ExtendMetadataType enum', function (): void {
    $casts = (new ExtendMetadata())->getCasts();
    expect($casts['etype'])->toBe(ExtendMetadataType::class);
});

it('belongs to a Provider', function (): void {
    expect((new ExtendMetadata())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('has children HasMany', function (): void {
    expect((new ExtendMetadata())->children())->toBeInstanceOf(HasMany::class);
});

it('can be created via factory', function (): void {
    $meta = ExtendMetadata::factory()->make();
    expect($meta)->toBeInstanceOf(ExtendMetadata::class)
        ->and($meta->etype)->toBe(ExtendMetadataType::Element);
});
