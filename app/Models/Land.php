<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Land extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'lands';

    protected $fillable = [
        'region_id',
        'market_id',
        'sub_market_id',
        'industrial_park_id',
        'developer_id',
        'owner_id',
        'contact_id',
        'land_name',
        'currency',
        'latitud',
        'longitud',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function market(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

    public function subMarket(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubMarket::class, 'sub_market_id');
    }

    public function developer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Developer::class, 'owner_id');
    }

    /*public function contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contact, 'contact_id');
    }*/

    public function industrialPark(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(IndustrialPark::class, 'industrial_park_id');
    }
}
