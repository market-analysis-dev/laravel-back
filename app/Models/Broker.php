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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Broker createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Broker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Broker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Broker query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Broker updatedBy($userId)
 * @mixin \Eloquent
 */
class Broker extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'cat_brokers';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
}
