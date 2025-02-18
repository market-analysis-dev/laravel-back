<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Cam extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'cams';

    protected $fillable = [
        'industrial_park_id',
        'developer_id',
        'region_id',
        'market_id',
        'submarket_id',
        'cam_building_sf',
        'cam_land_sf',
        'has_gardening_maintenance',
        'has_lightning_maintenance',
        'has_park_administration',
        'storm_sewer_maintenance',
        'has_survelliance',
        'has_management_fee ',
        'currency',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
