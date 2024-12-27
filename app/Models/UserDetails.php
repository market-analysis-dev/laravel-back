<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserDetails query()
 * @mixin \Eloquent
 */
class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'userdetails';

    protected $fillable = [
        'userId',
        'companyId',
        'address',
        'position',
        'profileImage',
        'state',
        'city',
        'status',
        'emailAddress',
        'phoneNumber',
    ];

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
