<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'middle_name',
        'last_name',
        'user_name',
        'company_id',
        'user_type_id',
        'total_screens',
        'password',
        'remember_token',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
}
