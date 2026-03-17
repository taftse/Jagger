<?php

use App\Enums\ContactType;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new Contact())->getTable())->toBe('contact');
});

it('has correct fillable attributes in snake_case', function (): void {
    $fillable = (new Contact())->getFillable();
    expect($fillable)->toContain('given_name')
        ->toContain('surname')
        ->toContain('email')
        ->toContain('type')
        ->toContain('is_sirtfi')
        ->toContain('phone')
        ->toContain('provider_id');
});

it('casts type as ContactType enum', function (): void {
    $casts = (new Contact())->getCasts();
    expect($casts['type'])->toBe(ContactType::class);
});

it('casts is_sirtfi as boolean', function (): void {
    $casts = (new Contact())->getCasts();
    expect($casts['is_sirtfi'])->toBe('boolean');
});

it('belongs to a Provider', function (): void {
    expect((new Contact())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $contact = Contact::factory()->make();
    expect($contact)->toBeInstanceOf(Contact::class)
        ->and($contact->type)->toBe(ContactType::Technical)
        ->and($contact->given_name)->not->toBeNull();
});
