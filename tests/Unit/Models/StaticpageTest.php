<?php

use App\Models\Staticpage;

it('has correct table name', function (): void {
    expect((new Staticpage())->getTable())->toBe('staticpage');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Staticpage())->getFillable();
    expect($fillable)->toContain('pcode')
        ->toContain('ptitle')
        ->toContain('ispublic')
        ->toContain('enabled');
});

it('casts boolean fields correctly', function (): void {
    $casts = (new Staticpage())->getCasts();
    expect($casts['ispublic'])->toBe('boolean')
        ->and($casts['enabled'])->toBe('boolean');
});

it('can be created via factory', function (): void {
    $page = Staticpage::factory()->make();
    expect($page)->toBeInstanceOf(Staticpage::class)
        ->and($page->pcode)->not->toBeNull()
        ->and($page->ispublic)->toBeTrue()
        ->and($page->enabled)->toBeTrue();
});
