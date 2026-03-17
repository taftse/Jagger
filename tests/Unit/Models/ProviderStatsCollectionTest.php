<?php

use App\Models\ProviderStatsCollection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new ProviderStatsCollection())->getTable())->toBe('providerstatscollection');
});

it('has correct fillable attributes in snake_case', function (): void {
    $fillable = (new ProviderStatsCollection())->getFillable();
    expect($fillable)->toContain('provider_id')
        ->toContain('stats_def_id')
        ->toContain('format')
        ->toContain('stat_filename');
    expect($fillable)->not->toContain('statdefinition_id')
        ->not->toContain('statfilename');
});

it('uses Laravel timestamps', function (): void {
    expect((new ProviderStatsCollection())->usesTimestamps())->toBeTrue();
});

it('belongs to a provider', function (): void {
    expect((new ProviderStatsCollection())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a stat definition', function (): void {
    $rel = (new ProviderStatsCollection())->statDefinition();
    expect($rel)->toBeInstanceOf(BelongsTo::class)
        ->and($rel->getForeignKeyName())->toBe('stats_def_id');
});

it('can be created via factory', function (): void {
    $coll = ProviderStatsCollection::factory()->make();
    expect($coll)->toBeInstanceOf(ProviderStatsCollection::class)
        ->and($coll->stat_filename)->not->toBeNull();
});
