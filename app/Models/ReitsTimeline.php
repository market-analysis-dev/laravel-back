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
 * @property int $id
 * @property int $reit_id
 * @property string $name
 * @property string $type
 * @property int $property
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline whereProperty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline whereReitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReitsTimeline whereUpdatedAt($value)
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
