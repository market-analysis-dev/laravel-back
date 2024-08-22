<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingsFeatures extends Model
{
    use HasFactory;

    protected $table = 'building_features';

    protected $fillable = [
        'building_id',
        'loading_door_id',
        'lighting',
        'ventilation',
        'transformer_capacity',
        'construction_type',
        'construction_state',
        'roof_system',
        'fire_protection_system',
        'skylights_sf',
        'coverage'
    ];

    // * Definir columnas de marca de tiempo personalizadas
    // const CREATED_AT = 'createdAt';
    // const UPDATED_AT = 'modifiedAt';
}
