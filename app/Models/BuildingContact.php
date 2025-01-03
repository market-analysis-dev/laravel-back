<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class BuildingContact extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'building_contacts';

    protected $fillable = [
      'contact_name',
      'contact_phone',
      'contact_email',
      'contact_comments',
      'created_by',
      'updated_by',
    ];
}
