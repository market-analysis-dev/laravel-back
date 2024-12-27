<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingDeal: string
{
    use EnumHelper;

    case SALE = 'Sale';
    case LEAS = 'Leas';
}
