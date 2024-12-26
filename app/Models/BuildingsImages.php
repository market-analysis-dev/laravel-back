<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsImages query()
 * @mixin \Eloquent
 */
class BuildingsImages extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'buildingId',
        'imageTypeId',
        'Image',
        'created_at',
        'updated_at'
    ];

    protected $table = 'building_images';

    // * Definir columnas de marca de tiempo personalizadas
    // const CREATED_AT = 'createdAt';
    // const UPDATED_AT = 'modifiedAt';
}
