<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class ReitCete extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $table = 'reit_cetes';

    protected $fillable = [
        'reit_id',
        'reit_type_id',
        'year',
        'quarter',
        'cbdfi',
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

    public function reit(): BelongsTo
    {
        return $this->belongsTo(Reit::class, 'reit_id');
    }

    public function reitType(): BelongsTo
    {
        return $this->belongsTo(ReitType::class, 'reit_type_id');
    }
}
