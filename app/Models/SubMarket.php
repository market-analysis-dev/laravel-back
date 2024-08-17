<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMarket extends Model
{
    use HasFactory;

    protected $table = 'cat_submarkets';

    protected $fillable = [
        'subMarketName',
        'marketId',
        'status',
    ];

    // * Definir columnas de marca de tiempo personalizadas
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'modifiedAt';
}
