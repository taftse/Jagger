<?php

use App\Models\CodeOfConduct;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

it('has correct table name', function (): void {
    expect((new CodeOfConduct())->getTable())->toBe('coc');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new CodeOfConduct())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('url')
        ->toContain('is_enabled');
});

it('casts is_enabled as boolean', function (): void {
    $casts = (new CodeOfConduct())->getCasts();
    expect($casts['is_enabled'])->toBe('boolean');
});

it('has no timestamps', function (): void {
    expect((new CodeOfConduct())->usesTimestamps())->toBeFalse();
});

it('belongs to many providers', function (): void {
    expect((new CodeOfConduct())->providers())->toBeInstanceOf(BelongsToMany::class);
});

it('can be created via factory', function (): void {
    $coc = CodeOfConduct::factory()->make();
    expect($coc)->toBeInstanceOf(CodeOfConduct::class)
        ->and($coc->name)->not->toBeNull()
        ->and($coc->url)->not->toBeNull();
});
