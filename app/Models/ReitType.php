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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitType withoutTrashed()
 * @mixin \Eloquent
 */
class ReitType extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'cat_reit_types';

    protected $fillable = [
        'name',
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
