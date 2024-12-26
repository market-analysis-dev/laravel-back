<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket query()
 * @mixin \Eloquent
 */
class SubMarket extends Model
{
    use HasFactory;

    protected $table = 'cat_submarkets';

    protected $fillable = [
        'subMarketName',
        'marketId',
        'status',
    ];

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
