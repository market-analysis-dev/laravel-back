<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Industry createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Industry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Industry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Industry query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Industry updatedBy($userId)
 * @mixin \Eloquent
 */
class Industry extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'cat_industries';

    protected $fillable = [
      'name',
      'created_by',
      'updated_by',
    ];
}
