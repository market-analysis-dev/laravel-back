<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionsPolicies extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'permissions_policies';

    protected $fillable = [
        // 'access_policy_id', 'module_id', 'market_id', 'sub_market_id', 'year', 'quarter', 'status',
        'access_policy_id', 'module_id', 'status',
    ];
}
