<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminBuildingsPermissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminBuildingsPermissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminBuildingsPermissions query()
 * @mixin \Eloquent
 */
class AdminBuildingsPermissions extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId', 'marketId', 'status', 'createdAt', 'modifiedAt',
    ];

    protected $table = 'admin_buildings_permissions';

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
