<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum Currency: string
{
    use EnumHelper;

    case USD = 'USD';
    case MXP = 'MXP';

}

