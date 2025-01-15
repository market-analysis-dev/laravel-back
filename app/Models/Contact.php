<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'comments',
        'has_building',
        'has_land',
        'has_broker',
        'has_company',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
