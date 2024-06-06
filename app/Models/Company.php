<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nameCompany', 'website', 'logoUrl', 'status', 'primaryColor',
        'secondaryColor', 'address', 'city', 'state',
        'postalCode', 'country', 'createdAt', 'modifiedAt',
    ];

    protected $table = 'companies';

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';

}
