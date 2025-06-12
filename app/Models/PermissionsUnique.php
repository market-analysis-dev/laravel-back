<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique query()
 * @property int $id
 * @property int $user_id
 * @property int $permission_id
 * @property string $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermissionsUnique whereUserId($value)
 * @mixin \Eloquent
 */
class PermissionsUnique extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId', 'permissionId', 'status', 'createdAt', 'modifiedAt',
    ];

    protected $table = 'permissions_unique';

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
