<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\File;

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
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket withoutTrashed()
 * @property string|null $latitude
 * @property string|null $longitude
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubMarket whereLongitude($value)
 * @mixin \Eloquent
 */
class SubMarket extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'cat_sub_markets';

    protected $fillable = [
        'name',
        'market_id',
        'status',
        'latitude',
        'longitude',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
