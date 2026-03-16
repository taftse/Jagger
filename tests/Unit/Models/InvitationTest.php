<?php

use App\Models\Invitation;

it('has correct table name', function (): void {
    expect((new Invitation())->getTable())->toBe('invitation');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Invitation())->getFillable();
    expect($fillable)->toContain('token')
        ->toContain('mailfrom')
        ->toContain('mailto')
        ->toContain('is_valid');
});

it('casts is_valid as boolean', function (): void {
    $casts = (new Invitation())->getCasts();
    expect($casts['is_valid'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new Invitation())->usesTimestamps())->toBeFalse();
});

it('can be created via factory', function (): void {
    $invitation = Invitation::factory()->make();
    expect($invitation)->toBeInstanceOf(Invitation::class)
        ->and($invitation->token)->not->toBeNull()
        ->and($invitation->is_valid)->toBeTrue();
});
