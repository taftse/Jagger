<?php

use App\Models\Partner;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

it('has correct table name', function (): void {
    expect((new Partner())->getTable())->toBe('partner');
});

it('has correct fillable attributes', function (): void {
    $fillable = (new Partner())->getFillable();
    expect($fillable)->toContain('name')
        ->toContain('homeurl')
        ->toContain('description');
});

it('has no timestamps', function (): void {
    expect((new Partner())->usesTimestamps())->toBeFalse();
});

it('belongs to many federations', function (): void {
    expect((new Partner())->federations())->toBeInstanceOf(BelongsToMany::class);
});

it('can be created via factory', function (): void {
    $partner = Partner::factory()->make();
    expect($partner)->toBeInstanceOf(Partner::class)
        ->and($partner->name)->not->toBeNull()
        ->and($partner->homeurl)->not->toBeNull();
});
