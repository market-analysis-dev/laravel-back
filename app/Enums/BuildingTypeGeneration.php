<?php

namespace App\Enums;

use App\Traits\EnumHelper;
use App\Interfaces\Enums\HasTranslation;

enum BuildingTypeGeneration: string
{
    use EnumHelper;

case FIRST = '1st Generation';
case SECOND = '2nd Generation';

    public function translation(): string
{
    return match ($this) {
        BuildingTypeGeneration::FIRST => __('1st Generation'),
        BuildingTypeGeneration::SECOND => __('2nd Generation'),
    };
}
}
