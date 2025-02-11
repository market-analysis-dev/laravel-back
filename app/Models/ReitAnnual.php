<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class ReitAnnual extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'reit_annual';

    protected $fillable = [
        'reit_id',
        'year',
        'quarter',
        'noi',
        'cap_rate',
        'occupancy',
        'm2',
        'sqft',
        'buildings',
        'customer_retention_rate',
        'average_rent',
        'contracts',
        'rental_income',
        'dolar',
        'prop_investment',
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
