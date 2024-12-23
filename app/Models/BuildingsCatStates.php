<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsCatStates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsCatStates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsCatStates query()
 * @mixin \Eloquent
 */
class BuildingsCatStates extends Model
{
    use HasFactory;

    protected $table = 'buildings_cat_states';

    protected $fillable = [
        'buildings_cat_states'
    ];

    // * Definir columnas de marca de tiempo personalizadas
    // const CREATED_AT = 'createdAt';
    // const UPDATED_AT = 'modifiedAt';
}
