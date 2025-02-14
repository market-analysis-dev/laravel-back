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
