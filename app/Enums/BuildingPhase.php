<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum BuildingPhase: string
{
    use EnumHelper;

    case BTS = 'BTS';
    case EXPANSION = 'Expansion';
    case INVENTORY = 'Inventory';
    case CONSTRUCTION = 'Construction';
    case PLANNED = 'Planned';
    case SUBLEASE = 'Sublease';
    case EXPIRATION = 'Expiration';

    public function translation(): string
    {
        return match ($this) {
            BuildingPhase::BTS => __('BTS'),
            BuildingPhase::EXPANSION => __('Expansion'),
            BuildingPhase::INVENTORY => __('Inventory'),
            BuildingPhase::CONSTRUCTION => __('Construction'),
            BuildingPhase::PLANNED => __('Planned'),
            BuildingPhase::SUBLEASE => __('Sublease'),
            BuildingPhase::EXPIRATION => __('Expiration'),
        };
    }

}
