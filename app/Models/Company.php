<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name_company', 'website', 'logo_url', 'status', 'primary_color',
        'secondary_color', 'altern_color', 'address', 'city', 'state',
        'postal_code', 'country'
    ];
}
