<?php

use App\Enums\CertificateType;
use App\Enums\CertificateUsage;
use App\Models\Certificate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('has correct table name', function (): void {
    expect((new Certificate())->getTable())->toBe('certificate');
});

it('has correct fillable attributes in snake_case', function (): void {
    $fillable = (new Certificate())->getFillable();
    expect($fillable)->toContain('type')
        ->toContain('cert_usage')
        ->toContain('cert_type')
        ->toContain('cert_data')
        ->toContain('enc_methods')
        ->toContain('is_default')
        ->toContain('key_name');
});

it('casts type as CertificateType enum', function (): void {
    $casts = (new Certificate())->getCasts();
    expect($casts['type'])->toBe(CertificateType::class);
});

it('casts cert_usage as CertificateUsage enum', function (): void {
    $casts = (new Certificate())->getCasts();
    expect($casts['cert_usage'])->toBe(CertificateUsage::class);
});

it('belongs to a Provider', function (): void {
    expect((new Certificate())->provider())->toBeInstanceOf(BelongsTo::class);
});

it('can be created via factory', function (): void {
    $cert = Certificate::factory()->make();
    expect($cert)->toBeInstanceOf(Certificate::class)
        ->and($cert->type)->toBe(CertificateType::IdpSso)
        ->and($cert->cert_usage)->toBe(CertificateUsage::Signing);
});
