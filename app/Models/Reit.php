<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit withoutTrashed()
 * @property int|null $reit_type_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reit whereReitTypeId($value)
 * @mixin \Eloquent
 */
class Reit extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'cat_reits';

    protected $fillable = [
        'name',
        'reit_type_id',
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
