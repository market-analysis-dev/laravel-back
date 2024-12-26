<?php

namespace App\Enums;

use App\Traits\EnumHelper;
use App\Interfaces\Enums\HasTranslation;

enum Currency: string
{
    use EnumHelper;

case USD = 'USD';
case MXP = 'MXP';

    public function translation(): string
{
    return match ($this) {
        Currency::USD => __('USD'),
        Currency::MXP => __('MXP'),
    };
}
}

