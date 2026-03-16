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
        ->toContain('urn')
        ->toContain('is_active')
        ->toContain('is_local');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new Federation())->getCasts();
    expect($casts['is_active'])->toBe('boolean')
        ->and($casts['is_protected'])->toBe('boolean')
        ->and($casts['is_public'])->toBe('boolean')
        ->and($casts['is_local'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new Federation())->usesTimestamps())->toBeFalse();
});

it('has many membership records', function (): void {
    expect((new Federation())->membership())->toBeInstanceOf(HasMany::class);
});

it('belongs to many categories', function (): void {
    expect((new Federation())->categories())->toBeInstanceOf(BelongsToMany::class);
});

it('belongs to many partners', function (): void {
    expect((new Federation())->partners())->toBeInstanceOf(BelongsToMany::class);
});

it('has many validators', function (): void {
    expect((new Federation())->validators())->toBeInstanceOf(HasMany::class);
});

it('has many notifications', function (): void {
    expect((new Federation())->notifications())->toBeInstanceOf(HasMany::class);
});

it('has many attribute requirements', function (): void {
    expect((new Federation())->attributeRequirements())->toBeInstanceOf(HasMany::class);
});

it('can be created via factory', function (): void {
    $fed = Federation::factory()->make();
    expect($fed)->toBeInstanceOf(Federation::class)
        ->and($fed->name)->not->toBeNull()
        ->and($fed->urn)->toStartWith('urn:');
});
