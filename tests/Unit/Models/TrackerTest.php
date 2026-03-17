<?php

use App\Models\Tracker;

it('has correct table name', function (): void {
    expect((new Tracker())->getTable())->toBe('tracker');
});

it('has correct fillable attributes in snake_case', function (): void {
    $fillable = (new Tracker())->getFillable();
    expect($fillable)->toContain('resource_type')
        ->toContain('resource_name')
        ->toContain('source_ip')
        ->toContain('user_agent')
        ->toContain('subtype')
        ->toContain('user')
        ->toContain('detail');
    expect($fillable)->not->toContain('resourcetype')
        ->not->toContain('resourcename')
        ->not->toContain('sourceip')
        ->not->toContain('useragent');
});

it('has no timestamps', function (): void {
    expect((new Tracker())->usesTimestamps())->toBeFalse();
});

it('casts created_at as datetime', function (): void {
    $casts = (new Tracker())->getCasts();
    expect($casts['created_at'])->toBe('datetime');
});

it('can be created via factory', function (): void {
    $tracker = Tracker::factory()->make();
    expect($tracker)->toBeInstanceOf(Tracker::class);
});
