<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use App\Models\File;

class Configuration extends Model
{
    use HasFactory, BlameableTrait, SoftDeletes;

    protected $fillable = [
        'file_id',
        'code',
        'name',
        'value',
        'description',
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
