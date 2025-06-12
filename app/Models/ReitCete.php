<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * 
 *
 * @property int $id
 * @property int $reit_id
 * @property int $reit_type_id
 * @property int $year
 * @property string $quarter
 * @property string $cbdfi
 * @property string $present_value
 * @property string $return
 * @property string $real_return
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Reit $reit
 * @property-read \App\Models\ReitType $reitType
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereCbdfi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete wherePresentValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereQuarter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereRealReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereReitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereReitTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitCete withoutTrashed()
 * @mixin \Eloquent
 */
class ReitCete extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'reit_cetes';

    protected $fillable = [
        'reit_id',
        'reit_type_id',
        'year',
        'quarter',
        'cbdfi',
        'present_value',
        'return',
        'real_return',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function reit(): BelongsTo
    {
        return $this->belongsTo(Reit::class, 'reit_id');
    }

    public function reitType(): BelongsTo
    {
        return $this->belongsTo(ReitType::class, 'reit_type_id');
    }
}
