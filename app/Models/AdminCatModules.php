<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
