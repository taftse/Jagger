<?php

use App\Models\FederationCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

it('has correct table name', function (): void {
    expect((new FederationCategory())->getTable())->toBe('fedcategory');
});

it('has correct fillable attributes in snake_case', function (): void {
    $fillable = (new FederationCategory())->getFillable();
    expect($fillable)->toContain('short_name')
        ->toContain('desc_name')
        ->toContain('description')
        ->toContain('is_default');
    expect($fillable)->not->toContain('shortname')
        ->not->toContain('descname')
        ->not->toContain('isdefault');
});

it('casts is_default as boolean', function (): void {
    $casts = (new FederationCategory())->getCasts();
    expect($casts['is_default'])->toBe('boolean');
});

it('belongs to many federations', function (): void {
    expect((new FederationCategory())->federations())->toBeInstanceOf(BelongsToMany::class);
});

it('can be created via factory', function (): void {
    $cat = FederationCategory::factory()->make();
    expect($cat)->toBeInstanceOf(FederationCategory::class)
        ->and($cat->short_name)->not->toBeNull();
});
