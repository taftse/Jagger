<?php

use App\Models\Tracker;

it('has correct table name', function (): void {
    expect((new Tracker())->getTable())->toBe('tracker');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Tracker())->getFillable();
    expect($fillable)->toContain('resourcetype')
        ->toContain('subtype')
        ->toContain('sourceip')
        ->toContain('created_at');
});

it('has no timestamps', function (): void {
    expect((new Tracker())->usesTimestamps())->toBeFalse();
});

it('can be created via factory', function (): void {
    $tracker = Tracker::factory()->make();
    expect($tracker)->toBeInstanceOf(Tracker::class);
});
