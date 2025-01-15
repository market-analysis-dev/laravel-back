<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market query()
 * @property int $id
 * @property string $name
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereUpdatedBy($value)
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market updatedBy($userId)
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Region|null $region
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market withoutTrashed()
 * @mixin \Eloquent
 */
class Market extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'cat_markets';

    protected $fillable = [
        'name',
        'status',
        'region_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function region():BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
