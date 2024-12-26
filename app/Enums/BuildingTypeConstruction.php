<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingTypeConstruction: string
{
    use EnumHelper;

    case TILT_UP = 'TILT_UP';
    case PRECAST = 'Precast';
    case BLOCK_SHEET_METAL = 'Block & Sheet Metal';
    case SHEET_METAL = 'Sheet Metal';

}
