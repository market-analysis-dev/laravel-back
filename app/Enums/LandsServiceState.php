<?php

namespace App\Enums;
use App\Traits\EnumHelper;

enum LandsServiceState: string
{
    use EnumHelper;

    case YES = 'Yes';
    case NO = 'No';
    case FEASIBILITY = 'Feasibility';
}
