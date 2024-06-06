<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'userId',
        'moduleId',
        'marketId',
        'subMarketId',
        'year',
        'quarter',
        'status',
        'createdAt',
        'modifiedAt'
    ];

    public $timestamps = false;

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleId');
    }

    public function market()
    {
        return $this->belongsTo(Market::class, 'marketId');
    }

    public function subMarket()
    {
        return $this->belongsTo(SubMarket::class, 'subMarketId');
    }
}
