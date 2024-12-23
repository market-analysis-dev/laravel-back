<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustrialParks newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustrialParks newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IndustrialParks query()
 * @mixin \Eloquent
 */
class IndustrialParks extends Model
{
    use HasFactory;

    protected $table = 'cat_industrial_park';

    protected $fillable = [
        'industrialParkName',
        'marketId',
        'subMarketId',
    ];

    // * Definir columnas de marca de tiempo personalizadas
    // const CREATED_AT = 'createdAt';
    // const UPDATED_AT = 'modifiedAt';
}
