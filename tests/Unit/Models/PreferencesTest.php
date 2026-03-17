<?php

use App\Models\Preferences;

it('has correct table name', function (): void {
    expect((new Preferences())->getTable())->toBe('preferences');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Preferences())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('stype')
        ->toContain('is_enabled')
        ->toContain('description');
});

it('casts is_enabled as boolean', function (): void {
    $casts = (new Preferences())->getCasts();
    expect($casts['is_enabled'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new Preferences())->usesTimestamps())->toBeFalse();
});

it('can be created via factory', function (): void {
    $pref = Preferences::factory()->make();
    expect($pref)->toBeInstanceOf(Preferences::class)
        ->and($pref->name)->not->toBeNull()
        ->and($pref->is_enabled)->toBeTrue();
});
