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
 * @property int $id
 * @property string $name
 * @property int $market_id
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereUpdatedBy($value)
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
