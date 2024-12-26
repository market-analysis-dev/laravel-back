<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

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
    use HasFactory, BlameableTrait;

    protected $table = 'cat_markets';

    protected $fillable = [
        'name',
        'status'
    ];
}
