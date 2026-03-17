<?php

declare(strict_types=1);

namespace App\Enums;

enum AttributeRequirementType: string
{
    case SP = 'SP';
    case Federation = 'FED';
}
