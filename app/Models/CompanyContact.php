<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyContact extends Model
{
    use HasFactory;

    protected $table = 'company_contacts';

    protected $fillable = [
        'company_id',
        'contact_id',
    ];
}
