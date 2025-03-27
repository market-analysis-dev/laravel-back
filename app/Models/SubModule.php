<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SubModule extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'submodules';

    protected $fillable = [
        'name',
        'module_id',
        'status',
    ];
}
