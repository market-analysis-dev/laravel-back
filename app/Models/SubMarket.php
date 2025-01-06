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
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket updatedBy($userId)
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
