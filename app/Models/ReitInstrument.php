<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class ReitInstrument extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'reit_instruments';

    protected $fillable = [
        'reit_type_id',
        'name',
        'present_value',
        'return',
        'real_return',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function reitType(): BelongsTo
    {
        return $this->belongsTo(ReitType::class, 'reit_type_id');
    }
}
