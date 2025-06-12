<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules query()
 * @property int $id
 * @property int $user_id
 * @property int $submodule_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules whereSubmoduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsSubModules whereUserId($value)
 * @mixin \Eloquent
 */
class PermissionsSubModules extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId', 'subModuleId', 'status'
    ];

    protected $table = 'permissions_submodules';
}
