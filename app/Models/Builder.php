<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * 
 *
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder updatedBy($userId)
 * @mixin \Eloquent
 */
class Builder extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'cat_builders';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
}
