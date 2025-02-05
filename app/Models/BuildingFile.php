<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property int $file_id
 * @property int $building_id
 * @property string $type
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingFile withoutTrashed()
 * @mixin \Eloquent
 */
class BuildingFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'building_files';
    protected $fillable = [
        'file_id',
        'building_id',
        'type',
        'path',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
