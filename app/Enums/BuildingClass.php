<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingClass: string
{
    use EnumHelper;

    case A = 'A';
    case B = 'B';
    case C = 'C';
}
