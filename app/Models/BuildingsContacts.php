<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingsContacts extends Model
{
    use HasFactory;

    protected $table = 'building_contacts';

    protected $fillable = [
        'building_id',
        'contact_name',
        'contact_phone',
        'contact_email',
        'contact_comments',
    ];
}
