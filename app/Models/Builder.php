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
 * @property int $id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Builder whereUpdatedBy($value)
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
