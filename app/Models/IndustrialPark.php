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
        'sub_market_id',
        'created_by',
        'updated_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // public function market()
    // {
    //     return $this->belongsTo(Market::class, 'market_id');
    // }

    // public function subMarket()
    // {
    //     return $this->belongsTo(SubMarket::class, 'sub_market_id');
    // }
}
