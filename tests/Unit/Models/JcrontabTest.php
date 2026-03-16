<?php

use App\Models\Jcrontab;

it('has correct table name', function (): void {
    expect((new Jcrontab())->getTable())->toBe('jcrontab');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Jcrontab())->getFillable();
    expect($fillable)->toContain('jcommand')
        ->toContain('isenabled')
        ->toContain('jcomment');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new Jcrontab())->getCasts();
    expect($casts['tonotify'])->toBe('boolean')
        ->and($casts['isenabled'])->toBe('boolean')
        ->and($casts['istemplate'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new Jcrontab())->usesTimestamps())->toBeFalse();
});

it('can be created via factory', function (): void {
    $cron = Jcrontab::factory()->make();
    expect($cron)->toBeInstanceOf(Jcrontab::class)
        ->and($cron->jcommand)->not->toBeNull()
        ->and($cron->isenabled)->toBeTrue();
});
