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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenunt createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenunt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenunt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenunt query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenunt updatedBy($userId)
 * @mixin \Eloquent
 */
class Tenant extends Model
{
    use HasFactory, BlameableTrait;

    protected $table = 'cat_tenants';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
}
