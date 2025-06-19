<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuildingFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file_id',
        'building_id',
        'type',
        'path',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
