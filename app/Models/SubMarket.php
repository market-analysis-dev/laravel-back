<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

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
    use HasFactory, BlameableTrait;

    protected $table = 'cat_submarkets';

    protected $fillable = [
        'name',
        'market_id',
        'status',
    ];

}
