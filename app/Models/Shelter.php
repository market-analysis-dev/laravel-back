<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter whereUpdatedBy($value)
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shelter whereDeletedBy($value)
 * @mixin \Eloquent
 */
class Shelter extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'cat_shelters';

    protected $fillable = [
      'name',
      'created_by',
      'updated_by',
      'deleted_by',
      'created_at',
      'updated_at',
      'deleted_at',
    ];
}
