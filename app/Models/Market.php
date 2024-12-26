<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market query()
 * @property int $id
 * @property string $name
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Market whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Market extends Model
{
    use HasFactory;

    protected $table = 'cat_markets';

    protected $fillable = [
        'marketName',
        'status'
    ];

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
