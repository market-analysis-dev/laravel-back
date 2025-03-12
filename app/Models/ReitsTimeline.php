<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property-read \App\Models\Reit|null $reit
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline query()
 * @mixin \Eloquent
 */
class ReitsTimeline extends Model
{
    use HasFactory;

    protected $table = 'reits_timeline';

    protected $fillable = [
        'reit_id',
        'name',
        'type',
        'property'
    ];

    public function reit(): BelongsTo
    {
        return $this->belongsTo(Reit::class, 'reit_id');
    }

}
