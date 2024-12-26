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
