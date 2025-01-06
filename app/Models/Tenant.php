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
 * @property int $id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereUpdatedBy($value)
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
