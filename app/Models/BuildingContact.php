<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_email
 * @property string $contact_comments
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereContactComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingContact withoutTrashed()
 * @mixin \Eloquent
 */
class BuildingContact extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'building_contacts';

    protected $fillable = [
      'contact_name',
      'contact_phone',
      'contact_email',
      'contact_comments',
      'created_by',
      'updated_by',
      'deleted_by',
    ];
}
