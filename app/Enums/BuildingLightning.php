<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingLightning: string
{
    use EnumHelper;

    case LED = 'LED';
    case T5 = 'T5';
    case T8 = 'T8';
    case METAL_HALIDE = 'Metal Halide';
    case NONE = 'None';
}
