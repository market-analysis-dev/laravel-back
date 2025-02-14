<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum LandsTypeBuyer: string
{
    use EnumHelper;
    
    case INDIVIDUAL = 'individual';
    case COMPANY = 'company';
    case GOVERNMENT = 'government';
}