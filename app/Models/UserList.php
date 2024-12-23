<?php

namespace App\Models;

// use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

# use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserType|null $usertypes
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserList query()
 * @mixin \Eloquent
 */
class UserList extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'list_users';

    protected $fillable = [
        'name',
        'lastName',
        'middleName',
        'userName',
        'password',
        'companyId',
        'userTypeId',
        'totalScreens',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';

    public function usertypes()
    {
        return $this->belongsTo(Usertype::class, 'userTypeId');
    }
}
