<?php

declare(strict_types=1);

namespace App\Enums;

enum ContactType: string
{
    case Technical = 'technical';
    case Administrative = 'administrative';
    case Support = 'support';
    case Billing = 'billing';
    case Other = 'other';
}
