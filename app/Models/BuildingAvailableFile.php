<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\BuildingTypeFile;

/**
 * 
 *
 * @property int $id
 * @property int $file_id
 * @property int $buildings_available_id
 * @property BuildingTypeFile $type
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BuildingAvailable $buildingsAvailable
 * @property-read \App\Models\File $file
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereBuildingsAvailableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingAvailableFile withoutTrashed()
 * @mixin \Eloquent
 */
class BuildingAvailableFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'buildings_available_files';

    protected $fillable = [
        'file_id',
        'buildings_available_id',
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'type' => BuildingTypeFile::class,
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function buildingsAvailable(): BelongsTo
    {
        return $this->belongsTo(BuildingAvailable::class);
    }

}
