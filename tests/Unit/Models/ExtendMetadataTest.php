<?php

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
        ->toContain('element');
});

it('has no timestamps', function (): void {
    expect((new ExtendMetadata())->usesTimestamps())->toBeFalse();
});

it('belongs to a provider', function (): void {
    expect((new ExtendMetadata())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a parent', function (): void {
    expect((new ExtendMetadata())->parent())->toBeInstanceOf(BelongsTo::class);
});

it('has many children', function (): void {
    expect((new ExtendMetadata())->children())->toBeInstanceOf(HasMany::class);
});

it('can be created via factory', function (): void {
    $em = ExtendMetadata::factory()->make();
    expect($em)->toBeInstanceOf(ExtendMetadata::class)
        ->and($em->etype)->not->toBeNull()
        ->and($em->element)->not->toBeNull();
});
