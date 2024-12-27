<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property-read \App\Models\Market|null $market
 * @property-read \App\Models\Module|null $module
 * @property-read \App\Models\SubMarket|null $subMarket
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permissions whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Permissions extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'userId',
        'moduleId',
        'marketId',
        'subMarketId',
        'year',
        'quarter',
        'status',
        'createdAt',
        'modifiedAt'
    ];

    public $timestamps = false;

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleId');
    }

    public function market()
    {
        return $this->belongsTo(Market::class, 'marketId');
    }

    public function subMarket()
    {
        return $this->belongsTo(SubMarket::class, 'subMarketId');
    }
}
