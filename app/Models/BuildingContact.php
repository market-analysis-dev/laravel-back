<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $building_id
 * @property int $contact_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Building $building
 * @property-read \App\Models\Contact $contact
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BuildingContact extends Model
{
    use HasFactory;

    protected $table = 'building_contacts';

    protected $fillable = [
        'building_id',
        'contact_id',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
