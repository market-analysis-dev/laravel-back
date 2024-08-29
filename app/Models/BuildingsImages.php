<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingsImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'buildingId',
        'imageTypeId',
        'Image',
    ];

    protected $table = 'building_images';

    // * Definir columnas de marca de tiempo personalizadas
    // const CREATED_AT = 'createdAt';
    // const UPDATED_AT = 'modifiedAt';
}
