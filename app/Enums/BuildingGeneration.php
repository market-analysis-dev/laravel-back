<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingGeneration: string
{
    use EnumHelper;

    case FIRST = '1st Generation';
    case SECOND = '2nd Generation';
}
