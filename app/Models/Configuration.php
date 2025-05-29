<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use App\Models\File;

/**
 * 
 *
 * @property int $id
 * @property int|null $file_id
 * @property string $code
 * @property string $name
 * @property string|null $value
 * @property string|null $description
 * @property string $type
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read File|null $file
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Configuration withoutTrashed()
 * @mixin \Eloquent
 */
class Configuration extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $fillable = [
        'file_id',
        'code',
        'name',
        'value',
        'description',
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
