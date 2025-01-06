<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Shelter extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'cat_shelters';

    protected $fillable = [
      'name',
      'created_by',
      'updated_by',
    ];
}
