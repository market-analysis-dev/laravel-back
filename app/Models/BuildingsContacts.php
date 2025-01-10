<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts query()
 * @property int $id
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_email
 * @property string $contact_comments
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereContactComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereUpdatedBy($value)
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BuildingsContacts whereDeletedBy($value)
 * @mixin \Eloquent
 */
class BuildingsContacts extends Model
{
    use HasFactory;

    protected $table = 'building_contacts';

    protected $fillable = [
        'building_id',
        'contact_name',
        'contact_phone',
        'contact_email',
        'contact_comments',
    ];
}
