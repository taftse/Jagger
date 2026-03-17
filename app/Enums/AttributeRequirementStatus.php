<?php

declare(strict_types=1);

namespace App\Enums;

enum AttributeRequirementStatus: string
{
    case Required = 'required';
    case Optional = 'optional';
}
