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
 * @property int $reit_type_id
 * @property string $name
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
 * @property-read \App\Models\ReitType $reitType
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument wherePresentValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereRealReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereReitTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitInstrument withoutTrashed()
 * @mixin \Eloquent
 */
class ReitInstrument extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'reit_instruments';

    protected $fillable = [
        'reit_type_id',
        'name',
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

    public function reitType(): BelongsTo
    {
        return $this->belongsTo(ReitType::class, 'reit_type_id');
    }
}
