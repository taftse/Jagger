<?php

use App\Models\FederationCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

it('has correct table name', function (): void {
    expect((new FederationCategory())->getTable())->toBe('fedcategory');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new FederationCategory())->getFillable();
    expect($fillable)->toContain('shortname')
        ->toContain('descname')
        ->toContain('description')
        ->toContain('isdefault');
});

it('casts isdefault as boolean', function (): void {
    $casts = (new FederationCategory())->getCasts();
    expect($casts['isdefault'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new FederationCategory())->usesTimestamps())->toBeFalse();
});

it('belongs to many federations', function (): void {
    expect((new FederationCategory())->federations())->toBeInstanceOf(BelongsToMany::class);
});

it('can be created via factory', function (): void {
    $cat = FederationCategory::factory()->make();
    expect($cat)->toBeInstanceOf(FederationCategory::class)
        ->and($cat->shortname)->not->toBeNull();
});
