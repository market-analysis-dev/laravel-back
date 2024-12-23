<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModulesColumn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModulesColumn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModulesColumn query()
 * @mixin \Eloquent
 */
class ModulesColumn extends Model
{
    use HasFactory;

    protected $table = 'modulescolumns';

    protected $fillable = [
        'columnName',
        'moduleId',
        'status'
    ];

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
