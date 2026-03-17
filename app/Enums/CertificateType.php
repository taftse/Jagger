<?php

declare(strict_types=1);

namespace App\Enums;

enum CertificateType: string
{
    case IdpSso = 'idpsso';
    case SpSso = 'spsso';
    case Sso = 'sso';
    case Encryption = 'encryption';
}
