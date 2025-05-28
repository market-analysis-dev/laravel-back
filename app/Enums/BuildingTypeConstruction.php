<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingTypeConstruction: string
{
    use EnumHelper;

    case TILTUP = 'Tiltup';
    case PRECAST = 'Precast';
    case CONCRETE_MASONRY_METAL_SHEET = 'Concrete Masonry & Metal Sheet';
    case HEBEL = 'Hebel';
    case CONCRETE_MASONRY = 'Concrete Masonry';
    case METAL_SHEET = 'Metal Sheet';
}
