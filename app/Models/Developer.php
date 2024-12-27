<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 *
 *
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer createdBy($userId)
 * @method static \Database\Factories\DeveloperFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Developer updatedBy($userId)
 * @mixin \Eloquent
 */
class Developer extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'cat_developers';

    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at'];
}
