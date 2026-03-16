<?php

use App\Models\JaggerQueue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new JaggerQueue())->getTable())->toBe('queue');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new JaggerQueue())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('action')
        ->toContain('token')
        ->toContain('is_confirmed');
});

it('casts is_confirmed as boolean', function (): void {
    $casts = (new JaggerQueue())->getCasts();
    expect($casts['is_confirmed'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new JaggerQueue())->usesTimestamps())->toBeFalse();
});

it('belongs to a creator user', function (): void {
    expect((new JaggerQueue())->creator())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $queue = JaggerQueue::factory()->make();
    expect($queue)->toBeInstanceOf(JaggerQueue::class)
        ->and($queue->token)->not->toBeNull()
        ->and($queue->is_confirmed)->toBeFalse();
});
