<?php

use App\Models\MailQueue;

it('has correct table name', function (): void {
    expect((new MailQueue())->getTable())->toBe('mailqueue');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new MailQueue())->getFillable();
    expect($fillable)->toContain('rcptto')
        ->toContain('msubject')
        ->toContain('mbody')
        ->toContain('issent');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new MailQueue())->getCasts();
    expect($casts['issent'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new MailQueue())->usesTimestamps())->toBeFalse();
});

it('can be created via factory', function (): void {
    $queue = MailQueue::factory()->make();
    expect($queue)->toBeInstanceOf(MailQueue::class)
        ->and($queue->rcptto)->not->toBeNull()
        ->and($queue->issent)->toBeFalse();
});
