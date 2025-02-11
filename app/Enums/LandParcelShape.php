<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum LandParcelShape: string
{
    use EnumHelper;

    case REGULAR = 'Regular';
    case IRREGULAR = 'Irregular';
}
