<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
