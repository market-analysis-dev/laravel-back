<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingsAbsorption extends Model
{
    use HasFactory;

    protected $table = 'buildings_absorption';

    protected $fillable = [
        'lease_term_month',
        'asking_rate_shell',
        'closing_rate',
        'KVAS',
        'closing_quarter',
        'lease_up',
        'month',
        'new_construction',
        'starting_construction',
        'building_id',
        'tenant_id',
        'industry_id',
        'final_use_id',
        'shelter_id',
        'copany_type_id'
    ];

    // * Definir columnas de marca de tiempo personalizadas
    // const CREATED_AT = 'createdAt';
    // const UPDATED_AT = 'modifiedAt';
}
