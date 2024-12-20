<?php

namespace App\Models;

// use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Spatie\Permission\Traits\HasRoles;

# use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles, BlameableTrait, HasFactory;

    protected $fillable = [];

    protected $hidden = [
        'password',
    ];
}
