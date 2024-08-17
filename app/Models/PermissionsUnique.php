<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionsUnique extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId', 'permissionId', 'status', 'createdAt', 'modifiedAt',
    ];

    protected $table = 'permissions_unique';

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
