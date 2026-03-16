<?php

use App\Models\AttributeRequirement;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new AttributeRequirement())->getTable())->toBe('attribute_requirement');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new AttributeRequirement())->getFillable();
    expect($fillable)->toContain('attribute_id')
        ->toContain('sp_id')
        ->toContain('fed_id')
        ->toContain('type');
});

it('has no timestamps', function (): void {
    expect((new AttributeRequirement())->usesTimestamps())->toBeFalse();
});

it('belongs to an attribute', function (): void {
    expect((new AttributeRequirement())->attribute())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a provider', function (): void {
    expect((new AttributeRequirement())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a federation', function (): void {
    expect((new AttributeRequirement())->federation())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $req = AttributeRequirement::factory()->make();
    expect($req)->toBeInstanceOf(AttributeRequirement::class)
        ->and($req->type)->toBeIn(['SP', 'FED']);
});
