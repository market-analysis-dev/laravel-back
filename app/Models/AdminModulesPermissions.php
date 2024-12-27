<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminModulesPermissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminModulesPermissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminModulesPermissions query()
 * @mixin \Eloquent
 */
class AdminModulesPermissions extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId', 'moduleId', 'status', 'createdAt', 'modifiedAt',
    ];

    protected $table = 'admin_modules_permissions';

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
