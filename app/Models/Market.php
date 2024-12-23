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
