<?php

declare(strict_types=1);

namespace App\Enums;

enum CertificateUsage: string
{
    case Signing = 'signing';
    case Encryption = 'encryption';
}
