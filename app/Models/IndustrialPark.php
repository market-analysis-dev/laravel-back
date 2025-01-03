<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustrialPark extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'market_id',
        'submarket_id',
        'created_by',
        'updated_by',
    ];

    public function market(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

    public function subMarket(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubMarket::class, 'submarket_id');
    }

    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
