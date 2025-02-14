<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingState: string {

    use EnumHelper;

    case AVAILABILITY = 'Availability';
    case ABSORPTION = 'Absorption';
}
