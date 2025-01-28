<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer createdBy($userId)
 * @method static \Database\Factories\DeveloperFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer updatedBy($userId)
 * @property int $id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereUpdatedBy($value)
 * @property int $is_developer
 * @property int $is_builder
 * @property int $is_owner
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereIsBuilder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereIsDeveloper($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereIsOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereIsUserOwner($value)
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer withoutTrashed()
 * @property int $is_user_owner
 * @property int|null $market_id
 * @property int|null $submarket_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereSubmarketId($value)
 * @mixin \Eloquent
 */
class Developer extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'cat_developers';

    protected $fillable = [
        'name',
        'is_developer',
        'is_builder',
        'is_owner',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
