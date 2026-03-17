<?php

use App\Models\Federation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('has correct table name', function (): void {
    expect((new Federation())->getTable())->toBe('federation');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Federation())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('sysname')
        ->toContain('urn')
        ->toContain('is_active')
        ->toContain('is_protected')
        ->toContain('is_public');
});

it('has members as BelongsToMany linking to providers', function (): void {
    expect((new Federation())->members())->toBeInstanceOf(BelongsToMany::class);
});

it('has categories BelongsToMany', function (): void {
    expect((new Federation())->categories())->toBeInstanceOf(BelongsToMany::class);
});

it('has validators HasMany', function (): void {
    expect((new Federation())->validators())->toBeInstanceOf(HasMany::class);
});

it('has attributeRequirements HasMany using federation_id', function (): void {
    $rel = (new Federation())->attributeRequirements();
    expect($rel)->toBeInstanceOf(HasMany::class)
        ->and($rel->getForeignKeyName())->toBe('federation_id');
});

it('can be created via factory', function (): void {
    $fed = Federation::factory()->make();
    expect($fed)->toBeInstanceOf(Federation::class)
        ->and($fed->name)->not->toBeNull()
        ->and($fed->urn)->not->toBeNull();
});
