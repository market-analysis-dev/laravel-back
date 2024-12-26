<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingPhase: string
{
    use EnumHelper;

case BTS = 'BTS';
case EXPANSION= 'Expansion';
case INVENTORY = 'Inventory';
case CONSTRUCTION = 'Construction';
case PLANNED = 'Planned';
case SUBLEASE = 'Sublease';
case EXPIRATION = 'Expiration';

}
