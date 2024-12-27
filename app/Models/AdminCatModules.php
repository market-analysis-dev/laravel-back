<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminCatModules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminCatModules newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AdminCatModules query()
 * @mixin \Eloquent
 */
class AdminCatModules extends Model
{
    use HasFactory;

    protected $fillable = [
        'moduleName', 'status', 'createdAt', 'modifiedAt',
    ];

    protected $table = 'admin_cat_modules';

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
