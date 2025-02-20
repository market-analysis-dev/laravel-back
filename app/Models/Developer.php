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
 * @property int|null $sub_market_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereMarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer whereSubmarketId($value)
 * @property-read \App\Models\Market|null $market
 * @property-read \App\Models\SubMarket|null $submarket
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer filter(array $filters)
 * @mixin \Eloquent
 */
class Developer extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'cat_developers';

    protected $fillable = [
        'market_id',
        'sub_market_id',
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

    public function market(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

    public function submarket(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Submarket::class, 'sub_market_id');
    }

    public function scopeFilter($query, array $filters)
    {
        foreach ($filters as $key => $value) {
            if (in_array($key, ['is_owner', 'is_builder', 'is_developer'])) {
                $query->where($key, filter_var($value, FILTER_VALIDATE_BOOLEAN));
            } elseif ($key === 'market' && !empty($value)) {
                $query->whereHas('market', function ($q) use ($value) {
                    $q->where('id', $value);
                });
            } elseif ($key === 'submarket' && !empty($value)) {
                $query->whereHas('submarket', function ($q) use ($value) {
                    $q->where('id', $value);
                });
            }
        }

        return $query;
    }
}
