<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingTenancy: string
{
    use EnumHelper;

case SINGLE = 'Single';
case MULTITENANT = 'Multitenant';

}
