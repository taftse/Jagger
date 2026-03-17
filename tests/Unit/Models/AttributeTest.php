<?php

use App\Models\Attribute;

it('has correct table name', function (): void {
    expect((new Attribute())->getTable())->toBe('attribute');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Attribute())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('full_name')
        ->toContain('oid')
        ->toContain('urn')
        ->toContain('in_metadata')
        ->toContain('description');
});

it('casts in_metadata as boolean', function (): void {
    $casts = (new Attribute())->getCasts();
    expect($casts['in_metadata'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new Attribute())->usesTimestamps())->toBeFalse();
});

it('can be created via factory', function (): void {
    $attribute = Attribute::factory()->make();
    expect($attribute)->toBeInstanceOf(Attribute::class)
        ->and($attribute->name)->not->toBeNull()
        ->and($attribute->in_metadata)->toBeTrue();
});
