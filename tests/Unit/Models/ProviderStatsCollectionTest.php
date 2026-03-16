<?php

use App\Models\ProviderStatsCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new ProviderStatsCollection())->getTable())->toBe('providerstatscollection');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new ProviderStatsCollection())->getFillable();
    expect($fillable)->toContain('provider_id')
        ->toContain('statdefinition_id')
        ->toContain('format')
        ->toContain('statfilename');
});

it('has no timestamps', function (): void {
    expect((new ProviderStatsCollection())->usesTimestamps())->toBeFalse();
});

it('belongs to a provider', function (): void {
    expect((new ProviderStatsCollection())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a stat definition', function (): void {
    expect((new ProviderStatsCollection())->statDefinition())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $stats = ProviderStatsCollection::factory()->make();
    expect($stats)->toBeInstanceOf(ProviderStatsCollection::class)
        ->and($stats->format)->not->toBeNull();
});
