<?php

use App\Models\NotificationList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new NotificationList())->getTable())->toBe('notificationlist');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new NotificationList())->getFillable();
    expect($fillable)->toContain('subscriber')
        ->toContain('type')
        ->toContain('isenabled')
        ->toContain('isapproved');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new NotificationList())->getCasts();
    expect($casts['isenabled'])->toBe('boolean')
        ->and($casts['isapproved'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new NotificationList())->usesTimestamps())->toBeFalse();
});

it('belongs to a user', function (): void {
    expect((new NotificationList())->user())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a provider', function (): void {
    expect((new NotificationList())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('belongs to a federation', function (): void {
    expect((new NotificationList())->federation())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $notification = NotificationList::factory()->make();
    expect($notification)->toBeInstanceOf(NotificationList::class)
        ->and($notification->type)->not->toBeNull()
        ->and($notification->isenabled)->toBeTrue();
});
