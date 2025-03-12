<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $land_id
 * @property int $contact_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contact $contact
 * @property-read \App\Models\Land $land
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandContact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandContact whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandContact whereLandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LandContact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LandContact extends Model
{
    use HasFactory;

    protected $table = 'land_contacts';

    protected $fillable = [
        'land_id',
        'contact_id',
    ];

    public function land(): BelongsTo
    {
        return  $this->belongsTo(Land::class, 'land_id');
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
