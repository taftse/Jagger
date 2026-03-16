<?php

use App\Models\MailLocalization;

it('has correct table name', function (): void {
    expect((new MailLocalization())->getTable())->toBe('maillocalization');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new MailLocalization())->getFillable();
    expect($fillable)->toContain('mgroup')
        ->toContain('lang')
        ->toContain('msgbody')
        ->toContain('msgsubject');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new MailLocalization())->getCasts();
    expect($casts['isdefault'])->toBe('boolean')
        ->and($casts['isenabled'])->toBe('boolean')
        ->and($casts['alwaysattach'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new MailLocalization())->usesTimestamps())->toBeFalse();
});

it('can be created via factory', function (): void {
    $mail = MailLocalization::factory()->make();
    expect($mail)->toBeInstanceOf(MailLocalization::class)
        ->and($mail->mgroup)->not->toBeNull()
        ->and($mail->isenabled)->toBeTrue();
});
