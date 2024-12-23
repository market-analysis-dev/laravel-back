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
