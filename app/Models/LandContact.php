<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandContact extends Model
{
    use HasFactory;

    protected $table = 'land_contacts';

    protected $fillable = [
        'land_id',
        'contact_id',
    ];

    public function land(): BelongsTo
    {
        return  $this->belongsTo(Land::class, 'land_id');
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
